<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;

/**
 * Description of CommerceClass
 *
 * @author alexey
 */
class CommerceController extends BaseController{
    
    /**
     * get the list of commerce
     * @return string
     */
    public function list() :string
    {
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Commerce'), '/console/commerce');
        $data = [
            'items' => model(CommerceModel::class)->getList($this->request->getLocale()),
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/commerce/list', $data);
    }
    
    public function chess(): ?string
    {
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Commerce'), '/console/commerce');
        $data = [
            'items' => model(SectionsModel::class)->getList($this->request->getLocale()),
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/commerce/chess', $data);
    }


    /**
     * create the commerce
     * @return type
     */
    public function create()
    {
        // verify if request method is not POST
        if ($this->request->getMethod() !== 'post') {
            $config = config(App::class);
            $this->breadcrumb->add(lang('Breadcrumb.Admin.Commerce'), '/console/commerce');
            $this->breadcrumb->add(lang('Breadcrumb.Admin.CommerceCreate'), '/console/commerce/create');
            $data = [
                'languages' => $config->supportedLocales,
                'default_language' => $config->defaultLocale,
                'breadcrumb' => $this->breadcrumb->render(),
                'residentials' => model(ResidentialsModel::class)->getResidentialsList($config->defaultLocale),
                'sections' => model(SectionsModel::class)->getSectionsList($config->defaultLocale),
                'floors' => model(FloorsImagesModel::class)->getFloorsCommerceList(),
            ];
            return view('admin/commerce/create', $data);
        }
        if (($id = model(CommerceModel::class)->createItem($this->request->getPost()))) {
            return redirect()->route('commerce_update', [$id])->with('message', 'Messages.Commerce.Insertatiton');
        }
        return redirect()->back()->withInput()->with('errors', model(CommerceModel::class)->errors());
    }
    
    /**
     * update commerce
     * @param int $id
     * @return type
     */
    public function update(int $id)
    {
        $config = config(App::class);
        $this->breadcrumb->add(lang('Admin.Breadcrumb.Commerce'), '/console/commerce');
        $this->breadcrumb->add(lang('Breadcrumb.Admin.SectionUpdate'), '/console/commerce/update');
        // verify if request method is not POST
        if ($this->request->getMethod() === 'post') {
            if (model(CommerceModel::class)->updateItem($id, $this->request->getPost())) {
                return redirect()->route('commerce_update', [$id])->with('message', 'Admin.Messages.Success.Updated');
            }
            return redirect()->back()->withInput()->with('errors', model(CommerceModel::class)->errors());
        }
        $data = [
            'languages' => $config->supportedLocales,
            'default_language' => $config->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
            'residentials' => model(ResidentialsModel::class)->getResidentialsList($config->defaultLocale),
            'sections' => model(SectionsModel::class)->getSectionsList($config->defaultLocale),
            'floors' => model(FloorsImagesModel::class)->getFloorsCommerceList(),
            'data' => model(CommerceModel::class)->find($id)->withTranslations()->withFloorImage(),
            'id' => $id,
        ];
        return view('admin/commerce/update', $data);
    }
    
    /**
     * save the data about poligon
     * @return object
     */
    public function poligonSave(): object
    {
        
        $commerce = model(CommerceModel::class)->find($this->request->getPost('commerce_id'));
        if(!$commerce){
            return $this->response->setJSON(['success' => false, 'message' => lang('Admin.Messages.Erorrs.NotFound')]);
        }
        $files = $this->request->getFileMultiple('files');

        foreach($files as $name => $file){

            if($file->isValid() && !$file->hasMoved() && in_array($file->getMimeType(), ['image/png','image/jpg','image/jpeg']) ){
                $file->move(IMGPATH . 'layouts', $file->getName(), true);
            }else{
                continue;
            }
            if($commerce->{$name} && file_exists(IMGPATH . 'layouts/' . $commerce->{$name})){
                unlink(IMGPATH . 'layouts/' . $commerce->{$name});  
            }
            $commerce->{$name} = $file->getName();
        }
        $commerce->poligon = $this->request->getPost('poligon');
        if(model(CommerceModel::class)->save($commerce)){
            return $this->response->setJSON(['success' => true, 'message' => lang('Admin.Messages.Success.Updated')]);
        }else{
            return $this->response->setJSON(['success' => false, 'message' => implode(', ', model(CommerceModel::class)->errors())]);
        }
        
    }
    
    public function poligonChange(){
        
    }
}
