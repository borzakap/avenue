<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;

/**
 * Description of ProgressController
 *
 * @author alexey
 */
class ProgressController extends BaseController{
    
    /**
     * list of progress
     * @return type
     */
    public function list(): string {
        $this->breadcrumb->add(lang('Residentials.Breadcrumb.Admin.Residentials'), '/admin/residentials');
        $data = [
            'items' => model(ProgressModel::class)->getList($this->request->getLocale()),
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/progress/list', $data);
    }

    /**
     * create progress
     * @return type
     */
    public function create() {
        // verify if request method is not POST
        if ($this->request->getMethod() !== 'post') {
            $this->breadcrumb->add(lang('Breadcrumb.Admin.Residentials'), '/admin/residentials');

            $data = [
                'languages' => config(App::class)->supportedLocales,
                'default_language' => config(App::class)->defaultLocale,
                'residentials' => model(ResidentialsModel::class)->getResidentialsList(config(App::class)->defaultLocale),
                'breadcrumb' => $this->breadcrumb->render(),
            ];
            return view('admin/progress/create', $data);
        }
        if (($id = model(ProgressModel::class)->createItem($this->request->getPost()))) {
            return redirect()->route('progress_update', [$id])->with('message', lang('Ading.Messages.Insertatiton'));
        }
        return redirect()->back()->withInput()->with('error', lang('Admin.Messages.Error.Insertatiton'));
    }

    /**
     * update progress
     * @param int $id
     * @return type
     */
    public function update(int $id) {
        $this->breadcrumb->add(lang('Breadcrumb.Admin.ResidentialUpdate'), '/admin/residentials/update');
        // verify if request method is not POST
        if ($this->request->getMethod() === 'post') {
            if (model(ProgressModel::class)->updateItem($id, $this->request->getPost())) {
                return redirect()->route('progress_update', [$id])->with('message', lang('Admin.Messages.Insertatiton'));
            }
            return redirect()->back()->withInput()->with('errors', model(ProgressModel::class)->errors());
        }
        $data = [
            'languages' => config(App::class)->supportedLocales,
            'default_language' => config(App::class)->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
            'residentials' => model(ResidentialsModel::class)->getResidentialsList(config(App::class)->defaultLocale),
            'data' => model(ProgressModel::class)->find($id)->withTranslations(),
            'id' => $id,
        ];
        return view('admin/progress/update', $data);
    }
    
    public function delete(int $id){
        
    }
    
    /**
     * upload new floor image
     * @return object
     */
    public function imageUpload(): object
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
            'progress_id' => $this->request->getPost('progress_id'),
            'order' => 1,
        ];
        if(!$id = model(ProgressImagesModel::class)->insert($data)){
            $return['message'] = implode(', ', model(ProgressImagesModel::class)->errors());
            return $this->response->setJSON($return);
        }
        $path = IMGPATH . 'progress/'.$data['image_name'];
        // prosses image
        \Config\Services::image()
                ->withFile($image)
                ->fit(1200, 800, 'center')
                ->save($path);
        // get the properties
        $info = \Config\Services::image('imagick')
                ->withFile($path)
                ->getFile()
                ->getProperties(true);
        // update meta for image
        $progressImage = model(ProgressImagesModel::class)->find($id);
        $progressImage->image_width = $info['width'] ?? 0;
        $progressImage->image_height = $info['height'] ?? 0;
        if(!model(ProgressImagesModel::class)->save($progressImage)){
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
    public function imagesLoad(): ?object
    {
        if(!$id = $this->request->getPost('id')){
            return $this->response->setJSON([]);
        }
        return $this->response->setJSON(model(ProgressImagesModel::class)->getImages($id));
    }
    
    /**
     * Updeting floors images
     * @return object|null
     */
    public function imageUpdate(): ?object
    {
        $return = [
            'message' => lang('Admin.Messages.Error.NotUpload'),
        ];
        if(!$this->request->getMethod() === 'post'){
            return $this->response->setJSON($return);
        }
        $progressImages = model(ProgressImagesModel::class)->find($this->request->getPost('id'));
        if($this->request->getPost('delete_img')){
            try{
                model(ProgressImagesModel::class)->delete($progressImages->id);
            } catch (\Exception $e) {
                if($e->getCode() == 1451){
                    $return['message'] = lang('Admin.Messages.Error.ImageUsed');
                    return $this->response->setJSON($return);
                }
            }
            if($progressImages->image_name && file_exists(IMGPATH . 'progress/' . $progressImages->image_name)){
                unlink(IMGPATH . 'progress/' . $progressImages->image_name);  
            }
            $return['message'] = lang('Admin.Messages.Success.Deleted');
        }else{
            $progressImages->main = $this->request->getPost('main');
            model(ProgressImagesModel::class)->save($progressImages);
            $return['message'] = lang('Admin.Messages.Success.Updated');
        }
        return $this->response->setJSON($return);
    }
}
