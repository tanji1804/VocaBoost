# 単語帳アプリ　「VocaBoost」

## 概要
友人「英単語帳をスキャンして、それをベースに暗記カードみたいなクイズアプリがあったらいいなーと」
名前の由来　chatGPTに出してもらった、「vocabulary　boost」をいじったもの。

## システム
- PHP Laravel
- bootstrap
- Google Cloud Vision API

## 機能
### 1.単語カードのスキャン
- Google Cloud Vision API を使って単語帳をスキャン
- スキャンした単語カードを登録
- 打ち込みで単語カードを登録することも可能
### 2.単語問題
- 登録したカードから出題
- 登録していなくてもできるように問題のテンプレートも用意
### 3.アカウント
- 1つのアカウントで複数の単語帳を登録できる

## タスク
- [ ] Controller
- [ ] Controllerに必要なfunction書く（中身は空）
- [ ] Route書き込む
- [ ] functionがきちんと飛ぶかURLたたいて確認
- [ ] Model書く
- [ ] Controller内部の処理を書き込む
- [ ] view書く
- [ ] Requestでバリデーション書く
- [ ] あとは書いて書いて仕様書どおりの動きができるまで書く
