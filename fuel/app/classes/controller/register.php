<?php
class Controller_Register extends Controller_Template
{
    public function action_index()
    {
        $this->template->title = '登録フォーム';
        $this->template->active_register = 'class=active';
        $this->template->button_path = '/list';
        $this->template->button_value = '一覧に戻る';
        $this->template->content = View::forge('register/index');
    }

    public function action_submit()
    {
        $common = new Model_Common();
        $val = $common->forge_validation();
        if ($val->run())
        {
            // csrf対策
            if (!Security::check_token())
            {
                throw new HttpInvalidINputException('ページ遷移が正しくありません');
            }
            // 登録フォームに入力された値をDBにセットする
            $post = $val->validated();
            if (Model_Register::set_term_data($post))
            {
                Response::redirect('list');
            }
            else
            {
                throw new HttpInvalidINputException('正しくデータベースに登録されませんでした。');
            }
        }
        else
        {
            $this->template->title = '登録フォーム:エラー';
            $this->template->button_path = '/list';
            $this->template->button_value = '一覧に戻る';
            $this->template->content = View::forge('register/index');
            $this->template->content->set_safe('html_error', $val->show_errors());
        }
    }
}
