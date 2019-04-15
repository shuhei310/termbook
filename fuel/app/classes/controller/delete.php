<?php
class Controller_Delete extends Controller_Template
{
    public function action_index()
    {
        // セッションのデータを受け取る
        $term_id = Session::get('term_id');
        if ($term_id)
        {
            $data['term_data'] = Model_Detail::get_term_data($term_id)[0];
            if (!$data['term_data'])
            {
                throw new HttpInvalidINputException('不正な値が入力されました。');
            }
        }
        else
        {
            throw new HttpInvalidINputException('不正な遷移です。');
        }

        $this->template->title = '削除確認';
        $this->template->content = View::forge('delete/index', $data);
    }
    public function action_submit()
    {
        $term_id = Session::get('term_id');
        if (Model_Delete::set_del_flg($term_id))
        {
            Session::delete('term_id');
            Response::redirect('../../list');
        }
        else
        {
            throw new HttpInvalidINputException('正しくデータベースが操作されませんでした。');
        }
    }
}
