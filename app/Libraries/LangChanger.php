<?php

namespace App\Libraries;

/**
 * Description of LangChanger
 *
 * @author alexey
 */
class LangChanger {

    private $translation;
    private $request;
    private $language;
    private $path;

    public function __construct() {
        $this->request = service('request');
        $this->language = $this->request->getLocale();
        $this->path = md5($this->request->uri->getPath());
        $this->translation = cache("{$this->path}_{$this->language}_translation");
    }

    public function translate(string $w, string $p = ''): string {
        if (!$p) {
            $p = 'common';
        }
        if(isset($this->translation[$p][$w])){
            return $this->translation[$p][$w];
        }
        
        // find $w in database
        $model = model(PagesTranslationsModel::class);
        $translations = $model->getTranslationBySlug($p, $this->language);
        foreach ($translations as $translation) {
            $this->translation[$translation->slug][$translation->code] = $translation->text;
        }
        if (!isset($this->translation[$p][$w])) {
            $this->translation[$p][$w] = '';
        }
        cache()->save("{$this->path}_{$this->language}_translation", $this->translation, 0);
        return $this->translation[$p][$w];
    }

    //put your code here
    public function langesLinks($params = []) {
        $config = config(App::class);
        $segments = current_url(true)->getSegments();
        $langes = [];
        foreach ($config->supportedLocales as $k => $lange) {
            $langes[$k]['text'] = $lange;
            $segments[0] = $lange;
            $langes[$k]['url'] = site_url($segments);
        }

        $data = [
            'langes' => $langes,
            'cur_lang' => $this->language,
        ];
        return view('site/seils/lang_changer', $data);
    }

}
