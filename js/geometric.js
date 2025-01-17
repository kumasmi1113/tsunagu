particlesJS('particles-js',{
  "particles":{

//--シェイプの設定----------
      "number":{
        "value":15, //シェイプの数(初期値80)
        "density":{
          "enable":true, //シェイプの密集度を変更するか否か(初期値true)
          "value_area":200 //シェイプの密集度(初期値200)
        }
      },
      "shape":{
        "type":"circle", //シェイプの形初期値circle（circle:丸、edge:四角、triangle:三角、polygon:多角形、star:星型、image:画像）
        "stroke":{
          "width":0, //シェイプの外線の太さ
          "color":"#ffcc00" //シェイプの外線の色
        },
        //typeをpolygonにした時の設定
        "polygon": {
          "nb_sides": 5 //多角形の角の数
        },
        //typeをimageにした時の設定
        "image": {
          "src": "images/hoge.png",
          "width": 100,
          "height": 100
        }
      },
      "color":{
        "value":"#a9b3e9" //シェイプの色
      },
      "opacity":{
        "value":2, //シェイプの透明度(初期値1)
        "random":true, //シェイプの透明度をランダムにするか否か(初期値false)
        "anim":{
          "enable":false, //シェイプの透明度をアニメーションさせるか否か(初期値false)
          "speed":10, //アニメーションのスピード(初期値10)
          "opacity_min":0.1, //透明度の最小値
          "sync":false //全てのシェイプを同時にアニメーションさせるか否か
        }
      },
      "size":{
        "value":8, //シェイプの大きさ(初期値5)
        "random":true, //シェイプの大きさをランダムにするか否か
        "anim":{
          "enable":true, //シェイプの大きさをアニメーションさせるか否か(初期値false)
          "speed":20, //アニメーションのスピード(初期値40)
          "size_min":0, //大きさの最小値
          "sync":false //全てのシェイプを同時にアニメーションさせるか否か
        }
      },
//--------------------

//--線の設定----------
      "line_linked":{
        "enable":true, //線を表示するか否か(true)
        "distance":150, //線をつなぐシェイプの間隔(初期値150)
        "color":"#797979", //線の色
        "opacity":0.4, //線の透明度
        "width":1 //線の太さ
      },
//--------------------

//--動きの設定----------
      "move":{
        "speed":5, //シェイプの動くスピード(初期値10)
        "straight":false, //個々のシェイプの動きを止めるか否か
        "direction":"bottom", //エリア全体の動き(none、top、top-right、right、bottom-right、bottom、bottom-left、left、top-leftより選択)
        "out_mode":"out" //エリア外に出たシェイプの動き(out、bounceより選択)
      }
//--------------------

    },

    "interactivity":{
      "detect_on":"canvas",
      "events":{

//--マウスオーバー時の処理----------
        "onhover":{
          "enable":false, //マウスオーバーが有効か否か
          // "mode":"repulse" //マウスオーバー時に発動する動き(下記modes内のgrab、repulse、bubbleより選択)
        },
//--------------------

//--クリック時の処理----------
        "onclick":{
          "enable":true, //クリックが有効か否か
          "mode":"push" //クリック時に発動する動き(下記modes内のgrab、repulse、bubble、push、removeより選択)
        },
//--------------------

      },

      "modes":{

//--カーソルとシェイプの間に線が表示される----------
        "grab":{
          "distance":400, //カーソルからの反応距離
          "line_linked":{
            "opacity":1 //線の透明度
          }
        },
//--------------------

//--シェイプがカーソルから逃げる----------
        "repulse":{
          "distance":200 //カーソルからの反応距離
        },
//--------------------

//--シェイプが膨らむ----------
        "bubble":{
          "distance":400, //カーソルからの反応距離
          "size":40, //シェイプの膨らむ大きさ
          "opacity":8, //膨らむシェイプの透明度
          "duration":2, //膨らむシェイプの持続時間(onclick時のみ)
          "speed":3 //膨らむシェイプの速度(onclick時のみ)
        },
//--------------------

//--シェイプが増える----------
        "push":{
          "particles_nb":4 //増えるシェイプの数
        },
//--------------------

//--シェイプが減る----------
        "remove":{
          "particles_nb":2 //減るシェイプの数
        }
//--------------------

      }
    },
    "retina_detect":true, //Retina Displayを対応するか否か
    "resize":true //canvasのサイズ変更にわせて拡大縮小するか否か
  }
);
