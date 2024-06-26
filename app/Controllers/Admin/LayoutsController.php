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

    
    public function list(): string {
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
                'plans' => model(PlansImagesModel::class)->getFloorsLayoutsList(),
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
            if (model(LayoutsModel::class)->updateItem($id, $this->request->getPost())) {
                return redirect()->route('layout_update', [$id])->with('message', lang('Admin.Messages.Insertatiton'));
            }
            return redirect()->back()->withInput()->with('errors', model(LayoutsModel::class)->errors());
        }
        $data = [
            'languages' => $config->supportedLocales,
            'default_language' => $config->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
            'residentials' => model(ResidentialsModel::class)->getResidentialsList($config->defaultLocale),
            'sections' => model(SectionsModel::class)->getSectionsList($config->defaultLocale),
            'floors' => model(FloorsImagesModel::class)->getFloorsLayoutsList(),
            'plans' => model(PlansImagesModel::class)->getFloorsLayoutsList(),
            'data' => model(LayoutsModel::class)->find($id)->withTranslations()->withFloorImage()->withPlanImage(),
            'id' => $id,
        ];
        return view('admin/layouts/update', $data);
    }

    /**
     * save section`s poligon
     * @return object
     */
    public function poligonSectionSave(): object
    {
        $layout = model(LayoutsModel::class)->find($this->request->getPost('layout_id'));
        if(!$layout){
            return $this->response->setJSON(['success' => false, 'message' => lang('Admin.Messages.Erorrs.NotFound')]);
        }
        $layout->poligon = $this->request->getPost('poligon');
        if(model(LayoutsModel::class)->save($layout)){
            return $this->response->setJSON(['success' => true, 'message' => lang('Admin.Messages.Success.Updated')]);
        }else{
            return $this->response->setJSON(['success' => false, 'message' => implode(', ', model(LayoutsModel::class)->errors())]);
        }
    }
    
    /**
     * save plan`s poligon
     * @return object
     */
    public function poligonPlanSave(): object
    {
        $layout = model(LayoutsModel::class)->find($this->request->getPost('layout_id'));
        if(!$layout){
            return $this->response->setJSON(['success' => false, 'message' => lang('Admin.Messages.Erorrs.NotFound')]);
        }
        $layout->plan_poligon = $this->request->getPost('plan_poligon');
        if(model(LayoutsModel::class)->save($layout)){
            return $this->response->setJSON(['success' => true, 'message' => lang('Admin.Messages.Success.Updated')]);
        }else{
            return $this->response->setJSON(['success' => false, 'message' => implode(', ', model(LayoutsModel::class)->errors())]);
        }
    }
    
    
    /**
     * save images for layout
     * @return object
     */
    public function imagesSave(): object
    {
        $layout = model(LayoutsModel::class)->find($this->request->getPost('layout_id'));
        if(!$layout){
            return $this->response->setJSON(['success' => false, 'message' => lang('Admin.Messages.Erorrs.NotFound')]);
        }
        $files = $this->request->getFileMultiple('files');

        foreach($files as $name => $file){

            if($file->isValid() && !$file->hasMoved() && in_array($file->getMimeType(), ['image/png','image/jpg','image/jpeg']) ){
                $image_name = $file->getRandomName();
                $file->move(IMGPATH . 'layouts', $image_name, true);
            }else{
                continue;
            }
            if($layout->{$name} && file_exists(IMGPATH . 'layouts/' . $layout->{$name})){
                unlink(IMGPATH . 'layouts/' . $layout->{$name});  
            }
            $layout->{$name} = $image_name;
        }
        if(model(LayoutsModel::class)->save($layout)){
            return $this->response->setJSON(['success' => true, 'message' => lang('Admin.Messages.Success.Updated')]);
        }else{
            return $this->response->setJSON(['success' => false, 'message' => implode(', ', model(LayoutsModel::class)->errors())]);
        }
        
    }
    
    /**
     * TODO
     * @return object
     */
    public function poligonChange(): object
    {
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

        $image = model(FloorsImagesModel::class)->getImage($floor_images_id);
        if(isset($image->image_name) && $image->image_name){
            $return['success'] = true;
            $return['image'] = base_url('images/sections/'.$image->image_name);
        }
        return $this->response->setJSON($return);
        
    }

}
