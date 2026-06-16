import './bootstrap';
import './echo';

Echo.private(`App.Models.User.${USER_ID}`)
.notification(function(data){
    alert(data.body)
})

Echo.private(`posts.${USER_ID}`)
.listen('.post-viewed',function(){
    alert('posst-viewed');
})