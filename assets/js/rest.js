const getData = async () => {
  const res = await fetch('http://food-science.tokyo/wp-json/wp/v2/food') // Promiseオブジェクト
  console.log(res)
  const foods = await res.json() // 上記で取ってきたオブジェクトをJSONデータとして取得する
  
  console.log(foods)

  let foodHtml = ''
// foodsの配列の中からデートを取りたい時は forEach( 変数 => {});で取れる。=>の手前は自分で作成した変数。{}の中に取りたいデートを書く。
  foods.forEach( food => {
    const html = `
      <div>
        <h3>${food.title.rendered}</h3>
        <p>${food.price}円</p>
      </div>
    `
    // 上記の取り出したデータ空にしておいたlet foodHtmlに入れる。
    foodHtml += html
  } )

  const foodList = document.querySelector('#food-list')
  // 'beforeend'でdivタグの閉じタグの前に入れる。endが閉じタグを意味していて、beforeでその前ということ。
  foodList.insertAdjacentHTML('beforeend', foodHtml)
}
getData() //作成した関数名() 関数の実行はこの記述が必要




