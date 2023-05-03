import Echo from 'laravel-echo'

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '5bf85ed0e70c59175982',
    cluster: 'eu',
    forceTLS: true
});

var channel = Echo.private(`App.Models.User.${userID}`);
channel.notification(function(data) {
    /*console.log(data);
    alert(data.body);*/
    alert(JSON.stringify(data));
});
