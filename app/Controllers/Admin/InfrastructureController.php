<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;

/**
 * Description of InfrastructureController
 *
 * @author alexey
 */
class InfrastructureController extends BaseController {
    
    /**
     * get list of items
     * @return string
     */
    public function list(): string {
        $this->breadcrumb->add(lang('Admin.Breadcrumb.Residentials'), '/console/residentials');
        $data = [
            'items' => model(InfrastructureModel::class)->getList($this->request->getLocale()),
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/infrastructure/list', $data);
    }
    
    /**
     * create item
     * @return type
     */
    public function create() {
        // verify if request method is not POST
        if ($this->request->getMethod() !== 'post') {
            $this->breadcrumb->add(lang('Admin.Breadcrumb.Layouts'), '/console/layouts');
            $this->breadcrumb->add(lang('Admin.Breadcrumb.LayoutsCreate'), '/console/layouts/create');

            $data = [
                'languages' => config(App::class)->supportedLocales,
                'default_language' => config(App::class)->defaultLocale,
                'breadcrumb' => $this->breadcrumb->render(),
                'residentials' => model(ResidentialsModel::class)->getResidentialsList(config(App::class)->defaultLocale),
                'types' => model(InfrastructureModel::class)->getInfrastructureTypes(),
            ];
            return view('admin/infrastructure/create', $data);
        }
        
        if (($id = model(InfrastructureModel::class)->createItem($this->request->getPost()))) {
            return redirect()->route('infrastructure_update', [$id])->with('message', lang('Layouts.Messages.Messages.Insertatiton'));
        }
        return redirect()->back()->withInput()->with('error', lang('Admin.Messages.Error.Insertatiton'));
    }

    /**
     * update item
     * @param int $id
     * @return type
     */
    public function update(int $id) {
        $this->breadcrumb->add(lang('Admin.Breadcrumb.Layouts'), '/console/layouts');
        $this->breadcrumb->add(lang('Admin.Breadcrumb.SectionUpdate'), '/console/layouts/update');
        // verify if request method is not POST
        if ($this->request->getMethod() === 'post') {
            if (model(InfrastructureModel::class)->updateItem($id, $this->request->getPost())) {
                return redirect()->route('infrastructure_update', [$id])->with('message', lang('Admin.Messages.Insertatiton'));
            }
            return redirect()->back()->withInput()->with('errors', model(InfrastructureModel::class)->errors());
        }
        $data = [
            'languages' => config(App::class)->supportedLocales,
            'default_language' => config(App::class)->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
            'residentials' => model(ResidentialsModel::class)->getResidentialsList(config(App::class)->defaultLocale),
            'types' => model(InfrastructureModel::class)->getInfrastructureTypes(),
            'data' => model(InfrastructureModel::class)->find($id)->withTranslations(),
            'id' => $id,
        ];
        return view('admin/infrastructure/update', $data);
    }
    
    /**
     * save images for infrastructure
     * @return object
     */
    public function imagesSave(): object
    {
        $item = model(InfrastructureModel::class)->find($this->request->getPost('id'));
        if(!$item){
            return $this->response->setJSON(['success' => false, 'message' => lang('Admin.Messages.Erorrs.NotFound')]);
        }
        $files = $this->request->getFileMultiple('files');

        foreach($files as $name => $file){

            if($file->isValid() && !$file->hasMoved() && in_array($file->getMimeType(), ['image/png','image/jpg','image/jpeg']) ){
                $image_name = $file->getRandomName();
                $file->move(IMGPATH . 'infrastructure', $image_name, true);
            }else{
                continue;
            }
            if($item->{$name} && file_exists(IMGPATH . 'infrastructure/' . $item->{$name})){
                unlink(IMGPATH . 'infrastructure/' . $item->{$name});  
            }
            $item->{$name} = $image_name;
        }
        if(model(InfrastructureModel::class)->save($item)){
            return $this->response->setJSON(['success' => true, 'message' => lang('Admin.Messages.Success.Updated')]);
        }else{
            return $this->response->setJSON(['success' => false, 'message' => implode(', ', model(InfrastructureModel::class)->errors())]);
        }
    }
}
