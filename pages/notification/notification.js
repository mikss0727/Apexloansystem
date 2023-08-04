
// get notification
$(document).ready(function(){
 var accType = document.getElementById("loged_in_type").value;
 if (accType == 'OP' || accType == 'CUS' || accType == 'SUPP') {
      function load_unseen_notification(view = accType+'view')
      {
           var empID = document.getElementById("loged_in").value;
           var cusID = document.getElementById("loged_in_cus_id").value;
           var accType = document.getElementById("loged_in_type").value;

        $.ajax({
         url:"notification/notification_query.php",
         method:"POST",
         data:{view:view,
            emp_id:empID,
              cus_id:cusID,
              acc_type:accType,
         },
         dataType:"json",
         success:function(data)
         {
          $('.notification-div').html(data.notification);
          if(data.unseen_notification > 0)
          {
           $('.count').html(data.unseen_notification);
          }
         }
        });
      }

    load_unseen_notification();

     
 $(document).on('click', '.notification-box', function(){
  $('.count').html('');
      var accType = document.getElementById("loged_in_type").value;
      if (accType == 'OP') {
        load_unseen_notification('OP');
      }
      else{
        load_unseen_notification('CUS');
      }
      
 });
 $(document).on('click', '.notification-div', function(){
  $('.count').html('');
  var accType = document.getElementById("loged_in_type").value;
      if (accType == 'OP') {
        load_unseen_notification('OP');
      }
      else{
        load_unseen_notification('CUS');
      }
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 }
 

 
});
