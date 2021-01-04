var navMain = document.querySelector('.main-nav');
var navToggle = document.querySelector('.main-nav__toggle');

navMain.classList.remove('main-nav--nojs');

navToggle.addEventListener('click', function() {
    if (navMain.classList.contains('main-nav--closed')) {
        navMain.classList.remove('main-nav--closed');
        navMain.classList.add('main-nav--opened');
    } else {
        navMain.classList.add('main-nav--closed');
        navMain.classList.remove('main-nav--opened');
    }
});


var sublistForauthors = document.querySelector('.sublist-forauthors');
var forauthorsToggle = document.querySelector('.sublist-forauthors__toggle');

if( forauthorsToggle !== null && sublistForauthors !== null) {
  forauthorsToggle.addEventListener('click', function() {
      if (sublistForauthors.classList.contains('sublist-forauthors--closed')) {
          sublistForauthors.classList.remove('sublist-forauthors--closed');
          sublistForauthors.classList.add('sublist-forauthors--opened');
      } else {
          sublistForauthors.classList.add('sublist-forauthors--closed');
          sublistForauthors.classList.remove('sublist-forauthors--opened');
      }
  });
}


var pageSidebar = document.querySelector('.page-sidebar');
var listToggle = document.querySelector('.list__toggle');

if (pageSidebar)
{
    pageSidebar.classList.remove('page-sidebar--nojs');
}

if (listToggle !== null && pageSidebar !== null )
{
    listToggle.addEventListener('click', function() {
        if (pageSidebar.classList.contains('page-sidebar--closed')) {
            pageSidebar.classList.remove('page-sidebar--closed');
            pageSidebar.classList.add('page-sidebar--opened');
        } else {
            pageSidebar.classList.add('page-sidebar--closed');
            pageSidebar.classList.remove('page-sidebar--opened');
        }
    });
}

var sublistArchive = document.querySelector('.sublist-archive');
var archiveToggle = document.querySelector('.sublist-archive__toggle');

if( archiveToggle !== null && sublistArchive !== null) {
  archiveToggle.addEventListener('click', function() {
      if (sublistArchive.classList.contains('sublist-archive--closed')) {
          sublistArchive.classList.remove('sublist-archive--closed');
          sublistArchive.classList.add('sublist-archive--opened');
      } else {
          sublistArchive.classList.add('sublist-archive--closed');
          sublistArchive.classList.remove('sublist-archive--opened');
      }
  });
}