/* adding edinamiic element*/
$('.add-new').click(function(e){
    e.preventDefault(e);
    var zzz = rand(5);
    blockHTML = $('.shablon').find('div').html();
    k = $('<div/>').html(blockHTML)
        .appendTo($('.block-to-add'));

    if (k.find('.panel-item')) {
        k.find('.panel-open').attr('href', '#' + zzz  );
        k.find('.panel-collapse').attr('id', zzz );
    }
    $('.remove-this').unbind('click');
    $('.remove-this').bind('click',removeEl);
})
g = 0;
$('.add-new-substance').click(function(e){
  e.preventDefault(e);

  blockHTML = $('.shablon-substance').find('div').html();
  k = $('<div class="new-substance" />').html(blockHTML)
    .appendTo($('.block-to-add-substance'));
  k.find('input[name="substance[]"]').attr('id', 'substance' + g);
  k.find('input[name="substance_id[]"]').attr('id', 'substance' + g + '_id');
  $('.autocomplete').unbind('keypress');
  $('.autocomplete').bind('keypress', autocomp);
  $('.remove-this').unbind('click');
  $('.remove-this').bind('click',removeEl);
g++
})

function rand(x) {
    k =''
   for(i=0;i<=x;i++){
       k += Math.floor(Math.random()*9);
   }
   return k;
}
$('.remove-this').bind('click',removeEl);
function removeEl(){
    $(this).parent().remove();
}

/* removing edinamiic element*/

$('.remove-slider').bind('click',removeEl);
function removeEl(){
    var uri;
    if($(this).parent().hasClass('thumbnail')){
        uri = '/admin/medicine/slider'
    }
    if($(this).parent().hasClass('thumbnail')){
        _this = $(this);
        ids = _this.parent().attr('data-id');
        spec = _this.parent().attr('data-spec');
        $.ajax({
            type: "POST",
            data: {'slider_id':ids, 'spec':spec},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: uri,
            success: function(data){
                if(data.success) {
                    alert("Слайдер обновлен");
                    _this.parent().remove();
                } else if (data.error) {
                    alert(data.error);
                }
            },
            error: function (data) {
                alert(data);
            }
        })
    }else {
        $(this).parent().remove();
    }
}
/* Filter Cities by Country */
$('#country').change(function(){
    country = $(this).val();
    $('#city option').each(function(){
        thisCountry =  $(this).attr('data-country');
        $(this).removeAttr('hidden');
        if(country != 0 && country != thisCountry) {
            $(this).attr('hidden','hidden');
        }
    })
});
$('.autocomplete').bind('keypress', autocomp);
function autocomp() {
  $('.autocomplete-suggestions ').remove();
  len = $(this).val().length;
  ids = $(this).attr('id');
      new autoComplete({
        selector: '#' + ids,
        minChars: 1,

        source: function(term, suggest){
          term = term.toLowerCase();
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/admin/medicine/customs',
            type: 'POST',
            data: { source:ids, value:term },
            success: function (data) {
              resp = []
              for( var key in data) {
                resp.push([key,data[key]]);
              }

              suggest(resp);
            }
          })
        },
        renderItem: function (item, search){
          return '<div class="autocomplete-suggestion"  data-id="'+item[0]+'" data-val="'+item[1]+'">'+item[1]+'</div>';
        },
        onSelect: function(e, term, item){
          e.type == 'keydown' ? e.preventDefault(e) : ''
          document.getElementById(ids+'_id').value = item.getAttribute('data-id');
        }
      })
}
// add new faq
$('#add-new').click(function(e){
    e.preventDefault(e);
    tinymce.remove('#added');
    tinymce.remove('#addedd');
    $('#add').append($('#123>div') );
    tinymce.init({
        selector: '#addedd, #added',
    });
    $('#add-new').remove();
});
// add new faq
// remove Adv image
$('.remove-image').bind('click',removeImg);
function removeImg(){
    var uri;

    uri = '/admin/static/delimg';

    _this = $(this);
    ids = _this.attr('data-img');
    src = _this.attr('data-src');
    console.log(src);
    $.ajax({
        type: "POST",
        data: {'data-img':ids, 'data-src':src},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: uri,
        success: function(data){
            if(data.success) {
                alert("Картинка удалена");
                _this.parent().siblings().remove();
                _this.parent().remove();
            } else if (data.error) {
                alert(123);
            }
        },
        error: function (data) {
            alert('Ошибка удаления!');
        }
    })
}