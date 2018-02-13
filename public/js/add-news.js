g = 0;
$('.add-new').click(function (e) {
    e.preventDefault(e);
    if (4 > g) {
        blockHTML = $('.sh').first().html();
        $(blockHTML).insertBefore(this);
        g++
        if (4 <= g) this.remove();
    } else {
        this.remove();
    }
})