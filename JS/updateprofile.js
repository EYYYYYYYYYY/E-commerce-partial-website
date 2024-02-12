function updateprofile(event){

    event.preventDefault();
    var formData = new FormData(document.getElementById('updateprofile'));
    $.ajax({
        type: 'POST',
        url: '../PHP/UpdateProfile.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);

            //Checks if data is already an object
            if (typeof data !== 'object') {
                try {
                    data = JSON.parse(data);
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    return;
                }
            }

            //Shows alert box
            if (data.status === 'success') {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', status, error);
        }
    });
}