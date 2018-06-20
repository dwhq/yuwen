class game {
    constructor() {
        this.data = []
        this.figure = [2, 4, 8];
        this.choice()
        this.towDiv();
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
        console.log(datas);
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
        } else {
            //判断游戏结束
            th.data.forEach(function (val, key) {

            })
            return false;
        }
    }

    //生成两个元素上的数字
    towDiv() {
        let th = this;
        for (let i = 0; i < 2; i++) {
            th.ranDiv()
        }
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
                        if (arr[j] == 0 || arr[j] != arr[k]) {
                            break;
                        }
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

    moveNex() {
        let th = this;
        for (let i = 0; i < 4; i++) {
            let arr = [];
            th.data.forEach(function (val, index) {
                arr[index] = val[i].getAttribute('val');
            });
            console.log(arr);
            for (let j = 3; j >=0; j--) {
                if (arr[j] != 0) {
                    for (let k = j - 1; k >=0; k--) {
                        console.log('k',arr[j],'j',arr[k]);
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
            for (let j = 3; j >=0; j--) {
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
            console.log(arr);
            for (let j = 0; j < 4; j++) {
                if (arr[j] != 0) {
                    for (let k = j + 1; k < 4; k++) {
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
            console.log(arr);
            for (let j = 3; j >=0; j--) {
                if (arr[j] != 0) {
                    for (let k = j - 1; k >=0; k--) {
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
            for (let j = 3; j >=0; j--) {
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
}

new game();