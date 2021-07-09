<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;

/**
 * Description 
 *
 * @author alexey
 */
class SectionsController extends BaseController{
    
    protected $helpers = ['form'];

    public function list(){
        $model = model(SectionsModel::class);
        $items = $model->getSections($this->request->getLocale());
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Sections'), '/admin/sections');
        $data = [
            'items' => $items,
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/sections/list', $data);
    }

    /**
     * create section
     * @return type
     */
    public function create(){
        // verify if request method is not POST
        if ($this->request->getMethod() !== 'post') {
            $config = config(App::class);
            $this->breadcrumb->add(lang('Breadcrumb.Admin.Sections'), '/admin/sections');
            $this->breadcrumb->add(lang('Breadcrumb.Admin.SectionCreate'), '/admin/sections/create');
            $residentials_model = model(ResidentialsModel::class);
            $data = [
                'languages' => $config->supportedLocales,
                'default_naguage' => $config->defaultLocale,
                'breadcrumb' => $this->breadcrumb->render(),
                'residentials' => $residentials_model->getResidentialsList($this->request->getLocale()),
            ];
            return view('admin/sections/create', $data);
        }
        $model = model(SectionsModel::class);
        if (($id = $model->createSection($this->request->getPost()))) {
            return redirect()->route('section_update', [$id])->with('message', lang('Sections.Messages.Messages.Insertatiton'));
        }
        return redirect()->back()->withInput()->with('error', lang('Sections.Messages.Error.Insertatiton'));
    }

    public function update(int $id){
        $model = model(SectionsModel::class);
        $config = config(App::class);
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Sections'), '/admin/sections');
        $this->breadcrumb->add(lang('Breadcrumb.Admin.SectionUpdate'), '/admin/sections/update');
        // verify if request method is not POST
        if ($this->request->getMethod() === 'post') {
            
        }
        $model = model(SectionsModel::class);
        $residentials = model(ResidentialsModel::class);
        $data = [
            'languages' => $config->supportedLocales,
            'default_naguage' => $config->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
            'residentials' => $residentials->getResidentialsList($this->request->getLocale()),
            'data' => $model->find($id)->withTranslations(),
            'section_id' => $id,
        ];
        return view('admin/sections/update', $data);
        
    }
    
    public function delete(int $id){
        
    }
    
    public function floorsUpload(){
        
        $return = [
            'success' => false,
            'message' => lang('Sections.Messages.Error.UndefinedError'),
        ];
        if (!$this->request->getMethod() === 'post') {
            $return['message'] = lang('Sections.Messages.Error.NotAjax');
            return $this->response->setJSON($return);
        }
        $section_id = $this->request->getPost('section_id');
        
        if ($img = $this->request->getFile('image_file')) {
            $name = $img->getRandomName();
            $data = [
                'image_name' => $name,
                'image_code' => $this->request->getPost('image_code') ?? $name,
                'image_mime' => $img->getMimeType(),
                'section_id' => $this->request->getPost('section_id'),
                'order' => 1,
                'image_size' => 0,
            ];
            $floorsImagesModel = model('FloorsImagesModel');
            $floorsImagesModel->save($data);
            $img->move(IMGPATH . 'sections', $name);
            $return['message'] = lang('Sections.Messages.Success.Uploaded');
            $return['success'] = true;

        }else{
            $return['message'] = lang('Sections.Messages.Error.NotUpload');
            return $this->response->setJSON($return);
        }
        
        return $this->response->setJSON($return);
    }

    /**
     * load floors images for current section
     * @return json
     */
    public function floorsLoad(){
        
        if(!$section_id = $this->request->getPost('section_id')){
            return $this->response->setJSON([]);
        }
        
        $floorsImagesModel = model('FloorsImagesModel');
        $floors_images = $floorsImagesModel->getSectionFloorsImages($section_id);
        return $this->response->setJSON($floors_images);
    }
    
    public function floorsDelete(){
        
    }
    public function floorsUpdate(){
        
    }
    //put your code here
}
