//Count 计数器
function weuiCount(names, MAX, MIN, STEP, obj) {
    var MAX = MAX, MIN = MIN, STEP = STEP;
    $(names[0]).click(function (e) {
        var $input = $(e.currentTarget).parent().find('.weui-count__number');
        var number = parseInt($input.val() || "0") - STEP;
        if (number < MIN) number = MIN;
        $input.val(number);
        if (typeof obj === 'function') {
            obj();
        }
    });
    $(names[1]).click(function (e) {
        var $input = $(e.currentTarget).parent().find('.weui-count__number');
        var number = parseInt($input.val() || "0") + STEP;
        if (number > MAX) number = MAX;
        $input.val(number);
        if (typeof obj === 'function') {
            obj();
        }
    });
}