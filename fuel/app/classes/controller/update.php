<?php
class Controller_Update extends Controller_Template
{
    public function action_index()
    {
        // セッションのデータを受け取る
        $data['terms'] = Model_Update::get_update_form(Session::get('term_id'));

        $this->template->title = '更新フォーム';
        $this->template->button_path = '/detail?term_id='.$data['terms']['term_id'];
        $this->template->button_value = '戻る';
        $this->template->content = View::forge('update/index', $data);
    }

    public function action_submit()
    {
        $common = new Model_Common();
        $val = $common->forge_validation_update();
        // セッションのデータを受け取る
        $term_data = Model_Update::check_update_form(Session::get('term_id'));

        if ($val->run())
        {
            // csrf対策
            if (!Security::check_token())
            {
                throw new HttpInvalidINputException('ページ遷移が正しくありません');
            }
            // 登録フォームに入力された値をDBにセットする
            $post = $val->validated();

            if (Model_Update::update_term_data($post,$term_data['term_id']))
            {
                Session::delete('term_id');
                Response::redirect('../../list');
            }
            else
            {
                throw new HttpInvalidINputException('正しくデータベースに登録されませんでした。');
            }
        }
        else
        {
            $data['terms'] = Input::post();
            $data['terms']['term_name'] = $term_data['term_name'];
            $this->template->title = '更新フォーム:エラー';
            $this->template->button_path = '/list';
            $this->template->button_value = '一覧に戻る';
            $this->template->content = View::forge('update/index', $data);
            $this->template->content->set_safe('html_error', $val->show_errors());
        }
    }
}
