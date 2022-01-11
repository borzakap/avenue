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
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Sections'), '/admin/sections');
        $data = [
            'items' => model(SectionsModel::class)->getList($this->request->getLocale()),
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/sections/list', $data);
    }

    /**
     * create section
     * @return RedirectResponse|string
     */
    public function create(){
        // verify if request method is not POST
        if ($this->request->getMethod() !== 'post') {
            $this->breadcrumb->add(lang('Breadcrumb.Admin.Sections'), '/admin/sections');
            $this->breadcrumb->add(lang('Breadcrumb.Admin.SectionCreate'), '/admin/sections/create');
            $data = [
                'languages' => config(App::class)->supportedLocales,
                'default_language' => config(App::class)->defaultLocale,
                'breadcrumb' => $this->breadcrumb->render(),
                'residentials' => model(ResidentialsModel::class)->getResidentialsList($this->request->getLocale()),
            ];
            return view('admin/sections/create', $data);
        }
        if (($id = model(SectionsModel::class)->createItem($this->request->getPost()))) {
            return redirect()->route('section_update', [$id])->with('message', lang('Sections.Messages.Messages.Insertatiton'));
        }
        return redirect()->back()->withInput()->with('error', lang('Sections.Messages.Error.Insertatiton'));
    }

    /**
     * Update section
     * @param int $id
     * @return RedirectResponse|string
     */
    public function update(int $id)
    {
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Sections'), '/admin/sections');
        $this->breadcrumb->add(lang('Breadcrumb.Admin.SectionUpdate'), '/admin/sections/update');
        // verify if request method is not POST
        if ($this->request->getMethod() === 'post') {
            if (model(SectionsModel::class)->updateItem($id, $this->request->getPost())) {
                return redirect()->route('section_update', [$id])->with('message', lang('Admin.Messages.Insertatiton'));
            }
            return redirect()->back()->withInput()->with('errors', model(SectionsModel::class)->errors());
        }
        $data = [
            'languages' => config(App::class)->supportedLocales,
            'default_language' => config(App::class)->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
            'floor_types' => model(FloorsImagesModel::class)->getFloorTypes(),
            'residentials' => model(ResidentialsModel::class)->getResidentialsList($this->request->getLocale()),
            'data' => model(SectionsModel::class)->find($id)->withTranslations()->withPlans(),
            'section_id' => $id,
        ];
        return view('admin/sections/update', $data);
    }
    
    public function delete(int $id){
        
    }
    
    /**
     * upload new floor image
     * @return object
     */
    public function floorsUpload() :object
    {
        $return = [
            'success' => false,
        ];
        // validate image
        $img_validate = $this->validate([
            'image_file' => 'uploaded[image_file]|mime_in[image_file,image/png,image/jpg,image/jpeg]'
        ]);
        if(!$img_validate){
            $return['message'] = lang('Admin.Messages.Errors.ImageNotValid');
            return $this->response->setJSON($return);
        }
        $image = $this->request->getFile('image_file');
        // insert data about section first 
        $data = [
            'image_name' => $image->getRandomName(),
            'image_code' => $this->request->getPost('image_code'),
            'section_id' => $this->request->getPost('section_id'),
            'floor_type' => $this->request->getPost('floor_type'),
            'order' => 1,
        ];
        if(!$id = model(FloorsImagesModel::class)->insert($data)){
            $return['message'] = implode(', ', model(FloorsImagesModel::class)->errors());
            return $this->response->setJSON($return);
        }
        $path = IMGPATH . 'sections/'.$data['image_name'];
        // prosses image
        \Config\Services::image()
                ->withFile($image)
                ->resize(1200, 800, true, 'width')
                ->save($path);
        // get the properties
        $info = \Config\Services::image('imagick')
                ->withFile($path)
                ->getFile()
                ->getProperties(true);
        // update meta for image
        $floorImage = model(FloorsImagesModel::class)->find($id);
        $floorImage->image_width = $info['width'] ?? 0;
        $floorImage->image_height = $info['height'] ?? 0;
        if(!model(FloorsImagesModel::class)->save($floorImage)){
            $return['message'] = lang('Admin.Messages.Errors.ImageNotResized');
            return $this->response->setJSON($return);
        }
        $return['success'] = true;
        $return['message'] = lang('Sections.Messages.Success.ImageUploaded');
        return $this->response->setJSON($return);
    }

    /**
     * load floors images for current section
     * @return object|null
     */
    public function floorsLoad() : ?object
    {
        if(!$id = $this->request->getPost('id')){
            return $this->response->setJSON([]);
        }
        return $this->response->setJSON(model(FloorsImagesModel::class)->getSectionFloorsImages($id));
    }
    
    /**
     * Updeting floors images
     * @return object|null
     */
    public function floorsUpdate() :?object
    {
        $return = [
            'message' => lang('Sections.Messages.Error.NotUpload'),
        ];
        if(!$this->request->getMethod() === 'post'){
            return $this->response->setJSON($return);
        }
        $floorsImages = model(FloorsImagesModel::class)->find($this->request->getPost('id'));
        if($this->request->getPost('delete_img')){
            try{
                model(FloorsImagesModel::class)->delete($floorsImages->id);
            } catch (\Exception $e) {
                if($e->getCode() == 1451){
                    $return['message'] = lang('Sections.Messages.Error.FloorImageUsed');
                    return $this->response->setJSON($return);
                }
            }
            if($floorsImages->image_name && file_exists(IMGPATH . 'sections/' . $floorsImages->image_name)){
                unlink(IMGPATH . 'sections/' . $floorsImages->image_name);  
            }
            $return['message'] = lang('Sections.Messages.Success.Deleted');
        }else{
            // validate image
            $img_validate = $this->validate([
                'image_file' => 'uploaded[image_file]|mime_in[image_file,image/png,image/jpg,image/jpeg]'
            ]);
            if($img_validate){
                $image = $this->request->getFile('image_file');
                // delete old image
                if($floorsImages->image_name && file_exists(IMGPATH . 'sections/' . $floorsImages->image_name)){
                    unlink(IMGPATH . 'sections/' . $floorsImages->image_name);  
                }
                // set new name
                $floorsImages->image_name = $image->getRandomName();
                $path = IMGPATH . 'sections/'.$floorsImages->image_name;
                // prosses image
                \Config\Services::image()
                        ->withFile($image)
                        ->resize(1200, 800, true, 'width')
                        ->save($path);
                // get the properties
                $info = \Config\Services::image('imagick')
                        ->withFile($path)
                        ->getFile()
                        ->getProperties(true);
                // update meta for image
                $floorsImages->image_width = $info['width'] ?? 0;
                $floorsImages->image_height = $info['height'] ?? 0;
            }
            $floorsImages->image_code = $this->request->getPost('image_code');
            model(FloorsImagesModel::class)->save($floorsImages);
            $return['message'] = lang('Sections.Messages.Success.Updated');
        }
        return $this->response->setJSON($return);
    }
    
    public function poligonCommerce(): ?object
    {
        $return = [
            'success' => false,
            'message' => lang('Sections.Messages.Error.NotUpload'),
        ];
        if(!$this->request->getMethod() === 'post'){
            return $this->response->setJSON($return);
        }
        $section = model(SectionsModel::class)->find($this->request->getPost('section_id'));
        if(!$section){
            $return['message'] = lang('Admin.Messages.Errors.SectionNotUpload');
            return $this->response->setJSON($return);
        }
        $section->commerce_poligon = $this->request->getPost('commerce_poligon');
        if(!model(SectionsModel::class)->save($section)){
            $return['message'] = lang('Admin.Messages.Errors.PoligonNotUpdated');
            return $this->response->setJSON($return);
        }
        $return['success'] = true;
        $return['message'] = lang('Admin.Messages.Seccess.PoligonUpdated');
        return $this->response->setJSON($return);
        
    }
    public function poligonLeaving(): ?object
    {
        $return = [
            'success' => false,
            'message' => lang('Sections.Messages.Error.NotUpload'),
        ];
        if(!$this->request->getMethod() === 'post'){
            return $this->response->setJSON($return);
        }
        $section = model(SectionsModel::class)->find($this->request->getPost('section_id'));
        if(!$section){
            $return['message'] = lang('Admin.Messages.Errors.SectionNotUpload');
            return $this->response->setJSON($return);
        }
        $section->leaving_poligon = $this->request->getPost('leaving_poligon');
        if(!model(SectionsModel::class)->save($section)){
            $return['message'] = lang('Admin.Messages.Errors.PoligonNotUpdated');
            return $this->response->setJSON($return);
        }
        $return['success'] = true;
        $return['message'] = lang('Admin.Messages.Seccess.PoligonUpdated');
        return $this->response->setJSON($return);
    }
    
    public function poligonPantry(): ?object
    {
        $return = [
            'success' => false,
            'message' => lang('Sections.Messages.Error.NotUpload'),
        ];
        if(!$this->request->getMethod() === 'post'){
            return $this->response->setJSON($return);
        }
        $section = model(SectionsModel::class)->find($this->request->getPost('section_id'));
        if(!$section){
            $return['message'] = lang('Admin.Messages.Errors.SectionNotUpload');
            return $this->response->setJSON($return);
        }
        $section->pantry_poligon = $this->request->getPost('pantry_poligon');
        if(!model(SectionsModel::class)->save($section)){
            $return['message'] = lang('Admin.Messages.Errors.PoligonNotUpdated');
            return $this->response->setJSON($return);
        }
        $return['success'] = true;
        $return['message'] = lang('Admin.Messages.Seccess.PoligonUpdated');
        return $this->response->setJSON($return);
    }
}
