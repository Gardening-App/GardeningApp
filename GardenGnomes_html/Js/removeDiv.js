$(function(){
  $('.commentDelete').click(function(e) {
    e.preventDefault();
    var commentID = $(e.target).attr('commentID');
    $('#' + commentID).remove();

    $.post( "dbhandler.php", {operation: "deleteComment", commentId: commentID});
    
  });

});
