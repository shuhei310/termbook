<?php
class Model_Detail extends Model
{
    /**
    * term_idから詳細画面表示用のデータを取得する
    * 用語データテーブルと関連データテーブルから詳細画面表示用のデータを取り出す
    *
    * @param string 用語ID $id
    * @return array(string => string) 用語詳細データ $query->execute()->as_array()
    */
    public static function get_term_data($id)
    {
        // $query = DB::select('tb_term.term_name', 'tb_term.meaning', 'tb_term.abbreviation', 'tb_term.remarks', 'tb_term.create_date', 'tb_term.update_date', 'tb_reference.reference_id', 'tb_reference.reference')
        // ->from('tb_term')
        // ->join('tb_reference', 'LEFT OUTER')
        // ->on('tb_term.term_id', '=', 'tb_reference.term_id')
        // ->where('tb_term.term_id', '=', $id)
        // ->and_where('tb_term.del_flg', '=', 0);
        $sql = 'SELECT t.term_id, t.term_name, t.meaning, t.abbreviation, t.remarks, t.create_date, t.update_date, r.reference_id, r.reference
        FROM tb_term t
        LEFT JOIN tb_reference r
        ON t.term_id = r.term_id
        WHERE t.term_id = :id
        AND t.del_flg = 0';
        $query = DB::query($sql);

        // パラメータ
        $query->param('id', $id);

        return $query->execute()->as_array();
    }

    /**
    * 取得した用語データに参考URLが何件入っているか取得する
    *
    * @param array(string => string) 用語データ $data
    * @return int 参考URLカウント $count
    */
    public static function count_reference_null($data)
    {
        $count = 0;
        foreach ($data as $value)
        {
            if (!empty($value['reference']))
            {
                $count++;
            }
        }
        return $count;
    }
}
