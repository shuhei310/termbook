-- term --
SET names utf8;
DROP DATABASE IF EXISTS term;
CREATE DATABASE term;
USE term;
DROP TABLE IF EXISTS tb_term CASCADE;

-- tb_term 用語情報テーブル --
CREATE TABLE tb_term(
    term_id                 INT(11)         AUTO_INCREMENT PRIMARY KEY  -- 用語ID
    , term_name             VARCHAR(100)    NOT NULL                    -- 用語名
    , meaning               TEXT            DEFAULT NULL                -- 意味
    , abbreviation          VARCHAR(100)    DEFAULT NULL                -- 略語
    , remarks               TEXT            DEFAULT NULL                -- 備考
    , create_date           DATETIME        DEFAULT NULL                -- 登録日時
    , update_date           DATETIME        DEFAULT NULL                -- 更新日時
    , del_flg               TINYINT(1)      DEFAULT 0                   -- 削除フラグ 0:未削除 1:削除済み
);

-- tb_reference 参考サイトテーブル --
CREATE TABLE tb_reference(
    reference_id            INT(11)         AUTO_INCREMENT PRIMARY KEY  -- 参考サイトID
    , term_id               INT(11)         NOT NULL                    -- 用語ID
    , reference             VARCHAR(255)    DEFAULT NULL                -- 参考サイトURL
    , create_date           DATETIME        DEFAULT NULL                -- 登録日時
    , update_date           DATETIME        DEFAULT NULL                -- 更新日時
    , FOREIGN KEY(term_id)       REFERENCES tb_term(term_id)
);
-- サンプルデータ --
-- tb_term --
INSERT INTO tb_term(term_id, term_name, meaning, abbreviation, remarks, create_date, update_date)
VALUES(101, "バッチ", "あらかじめ定めた処理を一度に行うこと。いつも決まったことを行う定型処理が多ければ、バッチファイルにしていつでも簡単に実行できるようにしておく。",
"", "はじめての投稿", "2018-07-11 15:00:00", "2018-07-11 15:00:00");
INSERT INTO tb_term(term_name, meaning, abbreviation, remarks, create_date, update_date)
VALUES("Solr", "”Apache Lucene” をベースにしたオープンソースの全文検索システム",
"", "二回目", "2018-07-11 16:30:00", "2018-07-11 16:30:00");
INSERT INTO tb_term(term_name, meaning, abbreviation, remarks, create_date, update_date)
VALUES("ベンダー", "ITのソフトウェアやサービス、システム、製品などを販売する企業のこと",
"", "", "2018-07-12 16:30:00", "2018-07-13 16:30:00");
INSERT INTO tb_term(term_name, meaning, abbreviation, remarks, create_date, update_date)
VALUES("ネットワークHDD","その名の通り、ネットワーク（LAN）上に接続することができるハードディスク",
"NAS", "", "2018-07-14 12:30:00", "2018-07-14 12:30:00");

-- tb_reference --
INSERT INTO tb_reference(reference_id, term_id, reference, create_date, update_date)
VALUES(1001, 101, "https://www.imkk.jp/blog/what-is-batch-processing.html", "2018-07-11 15:00:00", "2018-07-11 15:00:00");
INSERT INTO tb_reference(term_id, reference, create_date, update_date)
VALUES(102, "https://academy.gmocloud.com/know/20160106/1509", "2018-07-11 16:30:00", "2018-07-11 16:30:00");
INSERT INTO tb_reference(term_id, reference, create_date, update_date)
VALUES(103, "http://minto.tech/vendor-toha/", "2018-07-12 16:30:00", "2018-07-13 16:30:00");
INSERT INTO tb_reference(term_id, reference, create_date, update_date)
VALUES(103, "https://employment.en-japan.com/tenshoku-daijiten/14849/", "2018-07-12 16:30:00", "2018-07-13 16:30:00");
