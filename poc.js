var poc = {
    'poc_1' : 'https://code.google.com/p/chromium/issues/detail?id=143437 ',
    'poc_2' : 'https://code.google.com/p/chromium/issues/detail?id=37383',
    'poc_3' : 'https://code.google.com/p/chromium/issues/detail?id=143439',
    'poc_4' : 'https://code.google.com/p/chromium/issues/detail?id=98053',
    'poc_5' : 'https://code.google.com/p/chromium/issues/detail?id=117550',
    'poc_6' : 'https://code.google.com/p/chromium/issues/detail?id=90222'
}

var result_view_html = '<div class="panel-group" id="accordion">\
  <div class="panel panel-default">\
    <div class="panel-heading">\
      <h4 class="panel-title">\
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">\
          <bugpoctitle>\
        </a>\
      </h4>\
    </div>\
    <div id="collapseOne" class="panel-collapse collapse in">\
      <div class="panel-body">\
		<bugpoccontent>\
      </div>\
    </div>\
  </div>\
  <div class="panel panel-default">\
    <div class="panel-heading">\
      <h4 class="panel-title">\
        <a data-toggle="collapse" data-parent="#accordion"\
          href="#collapseTwo">\
          总共使用了<totoalpoctest>个poc，详情如下：\
        </a>\
      </h4>\
    </div>\
    <div id="collapseTwo" class="panel-collapse collapse">\
      <div class="panel-body">\
		<allpoccontent>\
      </div>\
    </div>\
  </div>\
</div>';



