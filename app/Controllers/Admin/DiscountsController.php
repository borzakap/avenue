<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;

/**
 * Description of DiscountsController
 *
 * @author alexey
 */
class DiscountsController extends BaseController {

    /**
     * get the list of items
     * @return string
     */
    public function list(): string {
        $this->data['items'] = model(DiscountsModel::class)->getList($this->request->getLocale());
        $this->data['counts'] = 0;
        return view('admin/discounts/list', $this->data);
    }

    /**
     * create the item
     * @return type
     */
    public function create() {
        // verify if request method is not POST
        if ($this->request->getMethod() !== 'post') {
            $this->data['value_types'] = model(DiscountsMetaModel::class)->getValueTipes();
            return view('admin/discounts/create', $this->data);
        }
        if (($id = model(DiscountsModel::class)->createItem($this->request->getPost()))) {
            return redirect()->route('discounts_update', [$id])->with('message', 'Admin.Messages.Success.Insertatiton');
        }
        return redirect()->back()->withInput()->with('errors', model(DiscountsModel::class)->errors());
    }

    /**
     * update item
     * @param int $id
     * @return type
     */
    public function update(int $id) {
        // verify if request method is not POST
        if ($this->request->getMethod() === 'post') {
            if (model(DiscountsModel::class)->updateItem($id, $this->request->getPost())) {
                return redirect()->route('discounts_update', [$id])->with('message', 'Admin.Messages.Success.Updated');
            }
            return redirect()->back()->withInput()->with('errors', model(DiscountsModel::class)->errors());
        }
        $this->data['value_types'] = model(DiscountsMetaModel::class)->getValueTipes();
        $this->data['data'] = model(DiscountsModel::class)->findItem($id)->withTranslations();
        $this->data['id'] = $id;
        return view('admin/discounts/update', $this->data);
    }
    
    /**
     * deleate item
     * @param int $id
     */
    public function delete(int $id){
        if(false !== model(DiscountsModel::class)->delete($id)){
            return redirect()->route('discounts')->with('message', lang('Console.Messages.Deleted'));
        }
        return redirect()->back()->withInput()->with('errors', model(DiscountsModel::class)->errors());
    }








    /**
     * save images
     * @return object
     */
    public function files(): object
    {
        $item = model(DiscountsModel::class)->find($this->request->getPost('id'));
        if(!$item){
            return $this->response->setJSON(['success' => false, 'message' => lang('Admin.Messages.Erorrs.NotFound')]);
        }
        $files = $this->request->getFileMultiple('files');

        foreach($files as $name => $file){

            if($file->isValid() && !$file->hasMoved() && in_array($file->getMimeType(), ['image/png','image/jpg','image/jpeg', 'application/pdf']) ){
                $file_name = $file->getRandomName();
                $file->move(IMGPATH . 'discounts', $file_name, true);
            }else{
                continue;
            }
            if($item->{$name} && file_exists(IMGPATH . 'discounts/' . $item->{$name})){
                unlink(IMGPATH . 'discounts/' . $item->{$name});  
            }
            $item->{$name} = $file_name;
        }
        if(model(DiscountsModel::class)->save($item)){
            return $this->response->setJSON(['success' => true, 'message' => lang('Admin.Messages.Success.Updated')]);
        }else{
            return $this->response->setJSON(['success' => false, 'message' => implode(', ', model(LayoutsModel::class)->errors())]);
        }
        
    }
}
