<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;

class ResidentialsController extends BaseController {

    protected $helpers = ['form'];
    
    /**
     * list of residentials
     * @return type
     */
    public function list(): string 
    {
        $this->breadcrumb->add(lang('Residentials.Breadcrumb.Admin.Residentials'), '/admin/residentials');
        $data = [
            'items' => model(ResidentialsModel::class)->getList($this->request->getLocale()),
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/residentials/list', $data);
    }

    /**
     * create residential
     * @return type
     */
    public function create() {
        // verify if request method is not POST
        if ($this->request->getMethod() !== 'post') {
            $this->breadcrumb->add(lang('Breadcrumb.Admin.Residentials'), '/admin/residentials');
            $this->breadcrumb->add(lang('Breadcrumb.Admin.ResidentialCreate'), '/admin/residentials/create');

            $data = [
                'languages' => config(App::class)->supportedLocales,
                'default_naguage' => config(App::class)->defaultLocale,
                'breadcrumb' => $this->breadcrumb->render(),
            ];
            return view('admin/residentials/create', $data);
        }
        if (($id = model(ResidentialsModel::class)->createItem($this->request->getPost()))) {
            return redirect()->route('residential_update', [$id])->with('message', lang('Residentials.Messages.Messages.Insertatiton'));
        }
        return redirect()->back()->withInput()->with('error', lang('Admin.Messages.Error.Insertatiton'));
    }

    /**
     * update residential
     * @param int $id
     * @return type
     */
    public function update(int $id) {
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Residentials'), '/admin/residentials');
        $this->breadcrumb->add(lang('Breadcrumb.Admin.ResidentialUpdate'), '/admin/residentials/update');
        // verify if request method is not POST
        if ($this->request->getMethod() === 'post') {
            
        }
        $data = [
            'languages' => config(App::class)->supportedLocales,
            'default_naguage' => config(App::class)->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
            'data' => model(ResidentialsModel::class)->find($id)->withTranslations(),
            'plans_type' => model(PlansImagesModel::class)->getTypes(),
            'residential_id' => $id,
        ];
        return view('admin/residentials/update', $data);
    }
    
    public function delete(int $id){
        
    }
    
    /**
     * upload new floor image
     * @return object
     */
    public function plansUpload(): object
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
            'residential_id' => $this->request->getPost('residential_id'),
            'plan_type' => $this->request->getPost('plan_type'),
            'order' => 1,
        ];
        if(!$id = model(PlansImagesModel::class)->insert($data)){
            $return['message'] = implode(', ', model(PlansImagesModel::class)->errors());
            return $this->response->setJSON($return);
        }
        $path = IMGPATH . 'plans/'.$data['image_name'];
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
        $planImage = model(PlansImagesModel::class)->find($id);
        $planImage->image_width = $info['width'] ?? 0;
        $planImage->image_height = $info['height'] ?? 0;
        if(!model(PlansImagesModel::class)->save($planImage)){
            $return['message'] = lang('Admin.Messages.Errors.ImageNotResized');
            return $this->response->setJSON($return);
        }
        $return['success'] = true;
        $return['message'] = lang('Admin.Messages.Success.ImageUploaded');
        return $this->response->setJSON($return);
    }

    /**
     * load floors images for current section
     * @return object|null
     */
    public function plansLoad(): ?object
    {
        if(!$id = $this->request->getPost('id')){
            return $this->response->setJSON([]);
        }
        return $this->response->setJSON(model(PlansImagesModel::class)->getImages($id));
    }
    
    /**
     * Updeting floors images
     * @return object|null
     */
    public function plansUpdate(): ?object
    {
        $return = [
            'message' => lang('Admin.Messages.Error.NotUpload'),
        ];
        if(!$this->request->getMethod() === 'post'){
            return $this->response->setJSON($return);
        }
        $planImages = model(PlansImagesModel::class)->find($this->request->getPost('id'));
        if($this->request->getPost('delete_img')){
            try{
                model(PlansImagesModel::class)->delete($planImages->id);
            } catch (\Exception $e) {
                if($e->getCode() == 1451){
                    $return['message'] = lang('Admin.Messages.Error.ImageUsed');
                    return $this->response->setJSON($return);
                }
            }
            if($planImages->image_name && file_exists(IMGPATH . 'plans/' . $planImages->image_name)){
                unlink(IMGPATH . 'plans/' . $planImages->image_name);  
            }
            $return['message'] = lang('Admin.Messages.Success.Deleted');
        }else{
            $planImages->image_code = $this->request->getPost('image_code');
            model(PlansImagesModel::class)->save($planImages);
            $return['message'] = lang('Admin.Messages.Success.Updated');
        }
        return $this->response->setJSON($return);
    }
    
        
}
