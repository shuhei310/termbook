<?php
class Model_Common extends Model
{
    // 用語登録エラーチェック
    public function forge_validation()
    {
        $val = Validation::forge();
        $val->add_callable('TermRules');

        $val->add('term_name', '用語名')
        ->add_rule('trim')
        ->add_rule('required')
        ->add_rule('max_length', 100)
        ->add_rule('no_match_value', '　')
        ->add_rule('unique', 'tb_term.term_name');

        $val->add('abbreviation', '略語')
        ->add_rule('trim')
        ->add_rule('no_match_value', '　')
        ->add_rule('max_length', 100);

        $val->add('meaning', '意味')
        ->add_rule('trim')
        ->add_rule('no_match_value', '　')
        ->add_rule('max_length', 500);

        for ($i=0; $i < 5; $i++) {
            $val->add('reference'.$i, '参考サイト')
            ->add_rule('trim')
            ->add_rule('max_length', 300)
            ->add_rule('valid_url');
        }

        $val->add('remarks', '備考')
        ->add_rule('trim')
        ->add_rule('no_match_value', '　')
        ->add_rule('max_length', 500);
        return $val;
    }
    // 用語更新エラーチェック
    public function forge_validation_update()
    {
        $val = Validation::forge();
        $val->add_callable('TermRules');

        $val->add('abbreviation', '略語')
        ->add_rule('trim')
        ->add_rule('no_match_value', '　')
        ->add_rule('max_length', 100);

        $val->add('meaning', '意味')
        ->add_rule('trim')
        ->add_rule('no_match_value', '　')
        ->add_rule('max_length', 500);

        for ($i=0; $i < 5; $i++) {
            $val->add('reference'.$i, '参考サイト')
            ->add_rule('trim')
            ->add_rule('max_length', 300)
            ->add_rule('valid_url');
        }

        $val->add('remarks', '備考')
        ->add_rule('trim')
        ->add_rule('no_match_value', '　')
        ->add_rule('max_length', 500);
        return $val;
    }
}
