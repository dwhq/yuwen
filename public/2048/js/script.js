class game {
    constructor() {
        this.data = []
        this.figure = [2, 4, 8];
        this.choice()
        this.towDiv();
        this.reset();
        onkeydown = (event) => {
            let key = event.which || event.keyCode;
            switch (key) {
                case 38:
                    //上
                    this.moveUp();
                    break;
                case 40:
                    //下
                    this.moveNex();
                    break;
                case 37:
                    //左
                    this.moveLeft();
                    break;
                case 39:
                    //右
                    this.moveRight();
                    break;
            }

        }
        //console.log(this.data)
    }

    choice() {
        let th = this;
        document.querySelectorAll('.gird-row').forEach(function (value, index) {
            value.querySelectorAll(`.gird-col`).forEach(function (vo, inde) {
                vo.innerHTML = '';
            })
            th.data[index] = value.querySelectorAll(`.gird-col`)
        })
    }

    //随机选择元素并生成数字
    ranDiv() {
        let th = this;
        let datas = 0;
        th.data.forEach(function (value) {
            value.forEach(function (vo) {
                if (vo.getAttribute('val') == 0) {
                    datas++
                }
            })
        })
       // console.log(datas);
        if (datas > 0) {
            let ran = Math.floor(Math.random() * 4);
            let rans = Math.floor(Math.random() * 4);
            if (th.data[ran][rans].getAttribute('val') == 0) {
                let rands = th.random();
                th.data[ran][rans].innerHTML = rands;
                th.data[ran][rans].setAttribute('val', rands);
            } else {
                th.ranDiv();
            }
        }
    }

    //生成两个元素上的数字
    towDiv() {
        let th = this;
        for (let i = 0; i < 2; i++) {
            th.ranDiv()
        }
        //判断游戏结束
        if (!th.verdict()) {
            alert('游戏结束');
            return false;
        }
        th.score();
    }

    //随机生成248数字
    random() {
        let ran = Math.floor(Math.random() * 3);
        return this.figure[ran];
    }

    //向上移动
    moveUp() {
        let th = this;
        for (let i = 0; i < 4; i++) {
            let arr = [];
            th.data.forEach(function (val, index) {
                arr[index] = val[i].getAttribute('val');
            });
            for (let j = 0; j < 4; j++) {
                if (arr[j] != 0) {
                    for (let k = j + 1; k < 4; k++) {
                        //相比较的这个数为空  跟下一个继续比较
                        if (arr[j] !=0 && arr[k] == 0){
                            continue;
                        }
                        //相邻的像个数不为空而且不相等退出
                        if (arr[j] == 0 || arr[j] != arr[k]) {
                            break;
                        }
                        //如果相邻的两个数字相等就把两个数字的和放在第一个数字的位置第二个数字的位置设置为空
                        if (arr[j] == arr[k]) {
                            th.data[j][i].innerHTML = parseInt(arr[j]) + parseInt(arr[k]);
                            th.data[k][i].innerHTML = '';
                            th.data[j][i].setAttribute('val', parseInt(arr[j]) + parseInt(arr[k]));
                            th.data[k][i].setAttribute('val', 0);
                            j++;
                            break;
                        }
                    }
                }
            }
            //如果前面是空的把后面的数字移动到前面
            for (let j = 0; j < 4; j++) {
                let val = th.data[j][i].getAttribute('val');
                if (val == 0) {
                    for (let k = j + 1; k < 4; k++) {
                        if (th.data[k][i].getAttribute('val') != 0) {
                            th.data[j][i].innerHTML = th.data[k][i].getAttribute('val');
                            th.data[k][i].innerHTML = '';
                            th.data[j][i].setAttribute('val', th.data[k][i].getAttribute('val'))
                            th.data[k][i].setAttribute('val', 0)
                            break;
                        }
                    }
                }
            }
        }
        th.towDiv();
    }

//向下移动
    moveNex() {
        let th = this;
        for (let i = 0; i < 4; i++) {
            let arr = [];
            th.data.forEach(function (val, index) {
                arr[index] = val[i].getAttribute('val');
            });
            for (let j = 3; j >= 0; j--) {
                if (arr[j] != 0) {
                    for (let k = j - 1; k >= 0; k--) {
                        //相比较的这个数为空  跟下一个继续比较
                        if (arr[j] !=0 && arr[k] == 0){
                            continue;
                        }
                        //相邻的像个数不为空而且不相等退出
                        if (arr[j] == 0 || arr[j] != arr[k]) {
                            break;
                        }
                        if (arr[j] == arr[k]) {
                            th.data[j][i].innerHTML = parseInt(arr[j]) + parseInt(arr[k]);
                            th.data[k][i].innerHTML = '';
                            th.data[j][i].setAttribute('val', parseInt(arr[j]) + parseInt(arr[k]));
                            th.data[k][i].setAttribute('val', 0);
                            j--;
                            break;
                        }
                    }
                }
            }
            for (let j = 3; j >= 0; j--) {
                let val = th.data[j][i].getAttribute('val');
                if (val == 0) {
                    for (let k = j - 1; k >= 0; k--) {
                        if (th.data[k][i].getAttribute('val') != 0) {
                            th.data[j][i].innerHTML = th.data[k][i].getAttribute('val');
                            th.data[k][i].innerHTML = '';
                            th.data[j][i].setAttribute('val', th.data[k][i].getAttribute('val'))
                            th.data[k][i].setAttribute('val', 0)
                            break;
                        }
                    }
                }
            }
        }
        th.towDiv();
    }

    moveLeft() {
        let th = this;
        for (let i = 0; i < 4; i++) {
            let arr = [];
            th.data[i].forEach(function (val, index) {
                arr[index] = val.getAttribute('val');
            });
            for (let j = 0; j < 4; j++) {
                if (arr[j] != 0) {
                    for (let k = j + 1; k < 4; k++) {
                        //相比较的这个数为空  跟下一个继续比较
                        if (arr[j] !=0 && arr[k] == 0){
                            continue;
                        }
                        //相邻的像个数不为空而且不相等退出
                        if (arr[j] !=0 && arr[k] == 0){
                            continue;
                        }
                        if (arr[j] == 0 || arr[j] != arr[k]) {
                            break;
                        }
                        if (arr[j] == arr[k]) {
                            th.data[i][j].innerHTML = parseInt(arr[j]) + parseInt(arr[k]);
                            th.data[i][k].innerHTML = '';
                            th.data[i][j].setAttribute('val', parseInt(arr[j]) + parseInt(arr[k]));
                            th.data[i][k].setAttribute('val', 0);
                            j++;
                            break;
                        }
                    }
                }
            }
            for (let j = 0; j < 4; j++) {
                let val = th.data[i][j].getAttribute('val');
                if (val == 0) {
                    for (let k = j + 1; k < 4; k++) {
                        if (th.data[i][k].getAttribute('val') != 0) {
                            th.data[i][j].innerHTML = th.data[i][k].getAttribute('val');
                            th.data[i][k].innerHTML = '';
                            th.data[i][j].setAttribute('val', th.data[i][k].getAttribute('val'))
                            th.data[i][k].setAttribute('val', 0)
                            break;
                        }
                    }
                }
            }
        }
        th.towDiv();
    }

    moveRight() {
        let th = this;
        for (let i = 0; i < 4; i++) {
            let arr = [];
            th.data[i].forEach(function (val, index) {
                arr[index] = val.getAttribute('val');
            });
            for (let j = 3; j >= 0; j--) {
                if (arr[j] != 0) {
                    for (let k = j - 1; k >= 0; k--) {
                        //相比较的这个数为空  跟下一个继续比较
                        if (arr[j] !=0 && arr[k] == 0){
                            continue;
                        }
                        //相邻的像个数不为空而且不相等退出
                        if (arr[j] == 0 || arr[j] != arr[k]) {
                            break;
                        }
                        if (arr[j] == arr[k]) {
                            th.data[i][j].innerHTML = parseInt(arr[j]) + parseInt(arr[k]);
                            th.data[i][k].innerHTML = '';
                            th.data[i][j].setAttribute('val', parseInt(arr[j]) + parseInt(arr[k]));
                            th.data[i][k].setAttribute('val', 0);
                            j--;
                            break;
                        }
                    }
                }
            }
            for (let j = 3; j >= 0; j--) {
                let val = th.data[j][i].getAttribute('val');
                if (val == 0) {
                    for (let k = j - 1; k >= 0; k--) {
                        if (th.data[i][k].getAttribute('val') != 0) {
                            th.data[i][j].innerHTML = th.data[i][k].getAttribute('val');
                            th.data[i][k].innerHTML = '';
                            th.data[i][j].setAttribute('val', th.data[i][k].getAttribute('val'))
                            th.data[i][k].setAttribute('val', 0)
                            break;
                        }
                    }
                }
            }
        }
        th.towDiv();
    }

    //判断是否还能否移动
    verdict() {
        let th = this;
        let state = 0;
        let arr = new Array();   //先声明一维
        for (var k = 0; k < 4; k++) {        //一维长度为i,i为变量，可以根据实际情况改变
            arr[k] = new Array();    //声明二维，每一个一维数组里面的一个元素都是一个数组
        }
        for (let i = 0; i < th.data.length; i++) {
            for (let j = 0; j < th.data[i].length; j++) {
                arr[i][j] = th.data[i][j].getAttribute('val');
            }
        }
        arr.forEach(function (value) {
            for (let i = 0; i < value.length; i++) {
                //如果有一个直接返回 true
                if (value[i] == value[i + 1]) {
                    state = 1;
                    break;
                }
            }
        })
        if (state == 1) {
            return true;
        } else {
            //将数组的行和列转换后继续比较
            let arrs = th.change(arr);
            arrs.forEach(function (values, index) {
                for (let i = 0; i < values.length; i++) {
                    //如果有一个直接返回 true
                    if (values[i] == values[i + 1]) {
                        state = 1;
                        break;
                    }
                }
            })
        }
        if (state == 1) {
            return true;
        } else {
            return false;
        }
    }

    //二维数组的行和列转换
    change(arr) {
        let new_arr = new Array();   //先声明一维
        for (var k = 0; k < 4; k++) {        //一维长度为i,i为变量，可以根据实际情况改变
            new_arr[k] = new Array();    //声明二维，每一个一维数组里面的一个元素都是一个数组
        }
        arr.forEach(function (value, index) {
            value.forEach(function (val, key) {
                new_arr[key][index] = val;
            })
        });
        return new_arr;
    }

    //重置游戏
    reset() {
        let th = this;
        document.querySelector('#newGame').onclick = function () {
            th.data.forEach(function (val) {
                val.forEach(function (vo) {
                    vo.innerHTML = '';
                    vo.setAttribute('val', 0);
                })
            })
            th.towDiv();
        }
    }
    //当前最高分数
    score(){
        let th = this;
        let score = 0;
        th.data.forEach(function (value) {
            value.forEach(function (vo) {
                let num = vo.getAttribute('val');
                if (parseInt(num) > parseInt(score)){
                    score = num;
                }
            })
        })
        document.querySelector('#game-score').innerHTML=score;
    }
}
new game();
