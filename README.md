# 単語帳アプリ　「VocaBoost」

友人「英単語帳をスキャンして、それをベースに暗記カードみたいなクイズアプリがあったらいいなーと」

名前の由来　chatGPTに出してもらった、「vocabulary　boost」をいじったもの。

## 基本要件

### 機能
- 単語カードのスキャン
  - Google Cloud Vision API を使って単語帳をスキャン？
  - スキャンした単語カードを登録
  - 打ち込みで単語カードを登録することも可能
- 単語問題
  - 登録したカードから出題
  - 登録していなくてもできるように問題のテンプレートも用意？
