g = 0;
$('.add-new').click(function (e) {
    e.preventDefault(e);
    if (4 > g) {
        // blockHTML = $('.sh').first().html();
        g++
        $('<div class="fill"><input id="form-control-' + g + '" name="file[]" type="file"><label for="form-control-' + g + '" class="texx0">Оберіть файл</label><label for="form-control-' + g + '" class="texx">Файл не обрано</label></div>').insertBefore(this);
        if (4 <= g) this.remove();
    } else {
        this.remove();
    }
})