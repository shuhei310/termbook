<?php
class Controller_List extends Controller_Template
{
    public function action_index()
    {
        $this->template->title = '用語一覧';
        $this->template->active_list = 'class=active';
        $sort_key = Input::get('sort_key');
        if ($sort_key)
        {
            if (Model_List::check_get_sort($sort_key))
            {
                $data['terms'] = Model_List::get_query_sort($sort_key,'desc');
            }
            else
            {
                throw new HttpInvalidINputException('不正な値が入力されました。');
            }
        }
        else
        {
            $data['terms'] = Model_List::get_query_sort('update_date','desc');
        }
        $this->template->content = View::forge('list/index', $data);
    }

    public function action_search()
    {
        $this->template->title = '検索結果';
        $post_word = Input::post('search_word');
        // 完全一致検索
        $data['terms'] = Model_List::get_query_perfect_search($post_word);
        if (!$data['terms'])
        {
            // 部分一致検索
            $data['terms'] = Model_List::get_query_partial_search($post_word);
            // var_dump($data['terms']);
            // exit;
        }
        $this->template->button_path = '/list';
        $this->template->button_value = '一覧に戻る';
        $this->template->content = View::forge('list/search', $data);
    }
}
