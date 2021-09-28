<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use CodeIgniter\Database\Exceptions\DataException;
/**
 * Description of LayoutsController
 *
 * @author alexey
 */
class LayoutsController extends BaseController {

    public function list() :string
    {
        $this->breadcrumb->add(lang('Admin.Breadcrumb.Residentials'), '/console/residentials');
        $data = [
            'items' => model(LayoutsModel::class)->getList($this->request->getLocale()),
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/layouts/list', $data);
    }

    public function create() {
        // verify if request method is not POST
        if ($this->request->getMethod() !== 'post') {
            $config = config(App::class);
            $this->breadcrumb->add(lang('Admin.Breadcrumb.Layouts'), '/console/layouts');
            $this->breadcrumb->add(lang('Admin.Breadcrumb.LayoutsCreate'), '/console/layouts/create');

            $data = [
                'languages' => $config->supportedLocales,
                'default_language' => $config->defaultLocale,
                'breadcrumb' => $this->breadcrumb->render(),
                'residentials' => model(ResidentialsModel::class)->getResidentialsList($config->defaultLocale),
                'sections' => model(SectionsModel::class)->getSectionsList($config->defaultLocale),
                'floors' => model(FloorsImagesModel::class)->getFloorsLayoutsList(),
            ];
            return view('admin/layouts/create', $data);
        }
        
        if (($id = model(LayoutsModel::class)->createItem($this->request->getPost()))) {
            return redirect()->route('layout_update', [$id])->with('message', lang('Layouts.Messages.Messages.Insertatiton'));
        }
        return redirect()->back()->withInput()->with('error', lang('Layouts.Messages.Error.Insertatiton'));
    }

    public function update(int $id) {
        $config = config(App::class);
        $this->breadcrumb->add(lang('Admin.Breadcrumb.Layouts'), '/console/layouts');
        $this->breadcrumb->add(lang('Admin.Breadcrumb.SectionUpdate'), '/console/layouts/update');
        // verify if request method is not POST
        if ($this->request->getMethod() === 'post') {
            if (($id = model(LayoutsModel::class)->updateItem($id, $this->request->getPost()))) {
                return redirect()->route('layout_update', [$id])->with('message', lang('Layouts.Messages.Messages.Insertatiton'));
            }
            return redirect()->back()->withInput()->with('error', lang('Layouts.Messages.Error.Updating'));
        }
        $data = [
            'languages' => $config->supportedLocales,
            'default_language' => $config->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
            'residentials' => model(ResidentialsModel::class)->getResidentialsList($config->defaultLocale),
            'sections' => model(SectionsModel::class)->getSectionsList($config->defaultLocale),
            'floors' => model(FloorsImagesModel::class)->getFloorsLayoutsList(),
            'data' => model(LayoutsModel::class)->find($id)->withTranslations()->withFloorImage(),
            'layout_id' => $id,
        ];
        return view('admin/layouts/update', $data);
    }

    /**
     * save poligon for layout
     * @return object
     */
    public function poligonSave(): object
    {
        
        $layout = model(LayoutsModel::class)->find($this->request->getPost('layout_id'));
        if(!$layout){
            return $this->response->setJSON(['success' => false, 'message' => lang('Admin.Messages.Erorrs.NotFound')]);
        }
        $files = $this->request->getFileMultiple('files');

        foreach($files as $name => $file){

            if($file->isValid() && !$file->hasMoved() && in_array($file->getMimeType(), ['image/png','image/jpg','image/jpeg']) ){
                $file->move(IMGPATH . 'layouts', $file->getName(), true);
            }else{
                continue;
            }
            if($layout->{$name} && file_exists(IMGPATH . 'layouts/' . $layout->{$name})){
                unlink(IMGPATH . 'layouts/' . $layout->{$name});  
            }
            $layout->{$name} = $file->getName();
        }
        $layout->poligon = $this->request->getPost('poligon');
        if(model(LayoutsModel::class)->save($layout)){
            return $this->response->setJSON(['success' => true, 'message' => lang('Admin.Messages.Success.Updated')]);
        }else{
            return $this->response->setJSON(['success' => false, 'message' => implode(', ', model(CommerceModel::class)->errors())]);
        }
        
    }
    
    public function poligonChange(){
        $return = [
            'success' => false,
            'message' => lang('Layouts.Messages.Error.UndefinedError'),
            'image' => false,
        ];
        if (!$this->request->getMethod() === 'post') {
            $return['message'] = lang('Layouts.Messages.Error.NotAjax');
            return $this->response->setJSON($return);
        }
        
        $floor_images_id = $this->request->getPost('floor_images_id');

        $image = model(LayoutsModel::class)->getImageFloor($floor_images_id);
        if(isset($image->image_name) && $image->image_name){
            $return['success'] = true;
            $return['image'] = base_url('images/sections/'.$image->image_name);
        }
        return $this->response->setJSON($return);
        
    }

}
