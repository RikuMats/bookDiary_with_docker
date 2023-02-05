# api List
## now
いったん完了　
- エラー処理を書く try
- 空欄で送ったときに送れないようにするかつデータベース更新しないようにする。
## sign up
http://localhost:8080/signup.php
### argument
name : user name
password: raw password
email : email 
### process
1. name,hashしたpassword, emailをデータベースに登録
2. verification codeを作成しセッションに保存してメール送信
3. tokenを作成するセッションに保存
4. レスポンスの送信
### response
{
  status: bool,
  token: string
}
## verification
http://localhost:8080/verification.php
### argument
id: user id
token: 
code: verification code
### process
1. セッションtokenと verification code取得
2. 送られてきたものとセッションのものでtoken verification code比較
3. 問題なければtrue返信
### response
{
  status: bool,
}

## sign in
http://localhost:8080/signin.php
### argument
id : user id
password: raw password

### process
1. データベースからidを検索しhashed passwordを取得
2. raw password とhashed passwordを比較
3. 問題なければトークンを返送

### response
{
  status: bool,
  token: string,
}
## fetchUserData
http://localhost:8080/fetchBooks.php
### argument
id: user id
token: 

### process
1. セッションからトークン取得
2. トークンに問題なければidでデータベースからuserNameとbookを取得(新しい順に並べておく)
3. booksを返送

### response
{
  status: bool,
  userName: string,
  books: List<{
    isbn: string,
    title: string,
    author: string,
    img_url: string,
     }>
  redBooks: List<{
    isbn: string,
    title: string,
    author: string,
    img_url: string,
    impression: string
     }>
}

## addBook
http://localhost:8080/addBook.php
### argument
id: user id
token: 
new Book: {
  isbn: string,
  title: string,
  author: string,
  img_url: string,
} 
### process
1. セッションからトークン取得
2. トークンに問題なければbooksMasterテーブルからisbn検索してなければ登録
3. idにisbnを紐付ける
4. trueを返送

### response
{
  status: bool,
}

## resistImpression
http://localhost:8080/resistImpression.php
### argument
id: user id
token: 
isbn: string
impression: string
### process
1. セッションからトークン取得
2. トークンにidとisbnで検索して見つけられコードにimpressionとredDateを追加
3. trueを返送

### response
{
  status: bool,
}

## fetchRedBook
http://localhost:8080/fetchRedBooks.php
### argument
none
### process
1. データベースからredBookを取得(新しい順に並べておく)
2. booksを返送

### response
{
  status: bool,
  redBooks: List<{
    isbn: string,
    title: string,
    author: string,
    img_url: string,
    impression: string
     }>
}

