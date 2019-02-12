var itms = $("figure").length;
var curItm = 0;
//baseZ represents z offset for zindex values
var baseZ = 10;
//topOfst represents the distribution offset for aboslutely positioning these elements
var topOfst = 70;

function reOrder() {
    for (i = 0; i < itms; i++) {
        if (i == curItm) {
            $("figure").eq(i).hide(0, function () {
                $(this).css({
                    "top": (itms - 1) * topOfst + "px",
                    "z-index": baseZ
                }).show();

            })
        } else {
            if (i < curItm) {
                var zVal = baseZ + curItm - i;
                var tVal = i + (itms - curItm) - 1;
                console.log(tVal);
            } else {
                var zVal = baseZ + itms - i + curItm;
                var tVal = i - curItm - 1;
            }

            $("figure").eq(i).animate({
                "top": ((tVal) * topOfst) + "px",
                "z-index": zVal
            }, 10);
        }


    }
    if (curItm == itms - 1) {
        curItm = 0;
    } else {
        curItm++;
    }
}

reOrder();

var reOrderTimer = setInterval(reOrder, 10000);

$("#tri-d-wrapper").hover(function () {
        clearInterval(reOrderTimer);
    }

    ,
    function () {
        reOrderTimer = setInterval(reOrder, 10000);
    }
);