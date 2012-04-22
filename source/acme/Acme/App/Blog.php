<?php
/**
 *
 * Generic application.
 *
 */
class Acme_App_Blog extends Acme_Controller_Page
{
    /**
     *
     * The default action when no action is specified.
     *
     * @var string
     *
     */
    protected $_action_default = 'index';
    protected $_layout_default = 'blog';
    protected $_model;
    public $list;
    public $form;
    public $item;
    public $comment;

    /**
     *
     * Generic index action.
     *
     * @return void
     *
     */
    public function _setup()
    {
        parent::_setup();
        //captcha
        $this->_action_format = array(
            'captcha' => array('png', 'mp3'),
        );
        $this->_model = Solar_Registry::get('model_catalog');
    }

    public function actionCaptcha()
    {
        // some configs for captcha
        $configs = array(
            'image_width' 		=> 140,
            'image_height' 		=> 50,
            'use_wordlist' 		=> false,
            'num_lines' 		=> 2,
            'image_signature' 	=> 'lifephp.com',
            'signature_color' 	=> array(rand(0, 64), rand(64, 128), rand(128, 255)),
            'multi_text_color' 	=> array(array(0xff, 0x0, 0x0), array(0x0, 0xff, 0x0), array(0xff, 0x99, 0xCC)),
        );
        $this->captcha_text = Solar::factory("Solar_Captcha_Text", $configs);
        $this->captcha_audio = Solar::factory("Solar_Captcha_Audio", $configs);
    }
    public function actionIndex($status = NULL)
    {
        $page = $this->_request->get('page', 1);
        if(NULL !== $status)
            $where = array('status = ?' => $status);
        else $where = array();
        $count = $this->_model->blogs->fetchAll()->count();
        $this->list = $this->_model->blogs->fetchAll(array(
            'eager'  => array('author', 'summary', 'comments', 'tags'), // eager fetch
            'where'  => $where,
            'page' => $page,
            'paging' => 2,
            'count_pages' => true,
        ));
        //$this->page_info = $this->list->getPagerInfo();
    }
   public function actionRead($id = null){
       $page = $this->_request->get('page', 1);
       if (! $id){
            return $this->_error('ERR_NO_ID_SPECIFIED');
       }
       $this->item = $this->_model->blogs->fetchOne(array(
            'eager'  => array('author', 'summary', 'comments', 'tags'), // eager fetch
            'where'  => array('`blogs`.`id` = ?' => $id),
        ));
       if(! $this->item){
            return $this->_error('ERR_NO_SUCH_ITEM');
       }
       $where = array('blog_id = ?' => $id);
       $this->comment = $this->_model->comments->fetchAll(array(
            'where'  => $where,
            'page' => $page, //当前第几页
            'paging' => 1,  //每页显示多少条数据
            'count_pages' => true,  //显示总页数
       ));
   }
   public function actionDrafts() {
       $fetch = array(
           'where' => array('blogs.status = ?' => 'draft'),
           'order' => 'blogs.created DESC',
           'page' => 'all',
       );
       $this->list = $this->_model->blogs->fetchAll($fetch);
   }
   public function actionEdit($id = null) {
       if(! $id){
            return $this->_error('ERR_NO_ID_SPECIFIED');
       }
       $this->item = $this->_model->blogs->fetch($id);
       if(! $this->item) {
           return $this->_error('ERR_NO_SUCH_ITEM');
       }
       if($this->_isProcess('save')) {
           $data = $this->_request->post('blog');
           $this->item->load($data);
           $this->item->save();
       }
       $this->form = $this->item->newForm(array(
          'status' => array(
                'label' => '状态',
           ),
          'title' => array(
                'label' => '标题',
           ),
          'body' => array(
                'type' => 'textarea',
                'label' => '内容',
                'attribs' => array(
                    'style' => 'border:solid 1px black;',
                    'cols'  => '60',
                    'rows'  =>  '10',
                ),
            ),
           'author_id' => array(
                'label'  =>  '作者',
                'attribs' => array(
                    'style' => 'border:solid 1px red;',
                    ),
           ),
       ));

       $this->_response->setNoCache();

   }
   public function actionAdd() {
       $this->item = $this->_model->blogs->fetchNew();
       if($this->_isProcess('save')){
           $data = $this->_request->post('blog');
           $this->item->load($data);
           $tags = explode(',', $data['tags']);
           $tag_all = $this->_model->tags->fetchAll();
           foreach($tags as $tag){
               $tag_r = $tag_all->appendNew(array(
                    'name' => trim($tag),
                ));

                $this->item->tags[] = $tag_r;
           }
           if($this->item->save()){
               $uri = "{$this->_controller}/edit/{$this->item->id}";
               return $this->_redirectNoCache($uri);
           }
       }
       $this->form = $this->item->newForm(array(
          'status' => array(
                'label' => '状态',
           ),
          'title' => array(
                'label' => '标题',
           ),
          'body' => array(
                'type' => 'textarea',
                'label' => '内容',
                'attribs' => array(
                    'style' => 'border:solid 1px black;',
                    'cols'  => '60',
                    'rows'  =>  '10',
                ),
            ),
           'author_id' => array(
                'label'  =>  '作者',
                'attribs' => array(
                    'style' => 'border:solid 1px red;',
                    ),
           ),
           'tags' => array(
                'label' => '标签',
                'descr' => '以逗号分隔',
           ),
       ));
       $this->_response->setNoCache();
   }
   public function actionDelete($id = null) {
       if(! $id){
           return $this->_error('ERR_NO_ID_SPECIFIED');
       }
       $this->item = $this->_model->blogs->fetch($id);
       if(! $this->item){
           return $this->_error('ERR_NO_SUCH_ITEM');
       }
       if($this->_isProcess('delete')){
           $this->item->delete();
           $this->_view = 'deleteSuccess';
       }
   }
}
