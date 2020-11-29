//function to open menu
function openMenu () {
    $(".drop-menu").slideToggle(1000);
}

//function to open login-form
function openLoginForm () {
    $(".login-form").slideToggle(1000);
}

//function to login
function login() {
    var Username = $("#Username");
    var Password = $("#Password");
    var inputError = false;
    var errorMsg = "";
    Username.removeClass('input-error');
    Password.removeClass('input-error');

    if (Username.val() == "") {
        Username.addClass('input-error');
        var inputError = true;
        var errorMsg = 'Username naw bang ya rit! ';
        $(".error").html(errorMsg);
    }

    if (Password.val() == "") {
        Password.addClass('input-error');
        var inputError = true;
        if (errorMsg) {
            errorMsg += "Password naw bang ya rit!";
        }
        else {
            var errorMsg = "Password naw bang ya rit!";
        }
        $(".error").html(errorMsg);
    }

    if (inputError == false) {
        $.ajax({
            type: "POST",
            url: "login.php",
            data: $("#login-form").serialize(),
            success: function(data) {
                var response = data;
                if (response == 1) {
                    var errorMsg = "";
                    window.location.href = 'home.html';
                }
                else {
                    var errorMsg = "Username shing nre Password shut taw ai!";
                    $(".error").html(errorMsg);
                }
            }
        });
    }
}

// function to check session
function checkSession (){
    $.ajax({
        url: "../check_session.php",
        method: "POST",
        success: function(data) {
            if (data == 0) {
                // alert("Session Expired!");
                window.location.href="index.html";
            }
            else {
                // var UsersName = data;                
                // $("#UsersName").html(UsersName);
                $(".nav-right").load('includes/nav-right.php');
            }
        }
    });
}

//function to logout
function logout () {
    window.location.href="logout.php";
}

//function to send contact page data
function sendContactPageData() {

    var Name = $("#Name");
    var Email = $("#Email");
    var Message = $("#Message");
    var inputError = false;
    var errorMsg = "";
    Name.removeClass('input-error');
    Email.removeClass('input-error');
    Message.removeClass('input-error');

    if (Name.val() == "" || Name.val() == null) {
        Name.addClass('input-error');
        var inputError = true;
        var errorMsg = "Please enter your name! ";
    }
    if (Email.val() == "" || Email.val() == null) {
        Email.addClass('input-error');
        var inputError = true;

        if (errorMsg) {
            errorMsg += "Please enter your email! ";
        }
        else {
            errorMsg = "Please enter your email! ";
        }
    }
    if (Message.val() == "" || Message.val() == null) {
        Message.addClass('input-error');
        var inputError = true;

        if (errorMsg) {
            errorMsg += "Your message cannot be blank!";
        }
        else {
            errorMsg = "Your message cannot be blank!";
        }
    }

    if (inputError == false) {
        $.ajax({
            type: "POST",
            url: "contactus.php",
            data: $("#contact-form").serialize(),
            success: function(data) {
                alert(data);
            }
        });
    }
    $(".error").html(errorMsg);
}

//function to validate email 
// Note function copied from Stackoverflow.com
function validateEmail(sEmail) {
  var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

  if(!sEmail.match(reEmail)) {
    alert("Email address n jaw ai!");
    return false;
  }
  return true;
}


//                                          ********************** Functions for registrations ***************************

//function to check for username duplication
function checkUsername () {
    var Username = $("#Username1");
    var l = Username.val().trim().length;
    
    if (l > 12) {
        //if username is longer than 12 characters
        $("#usernameError").addClass('error');
        $("#usernameError").html('Username gasi 12 hta nmai jan ai!');
        $("#btn-submit").attr("disabled", "disabled");
    }
    else if (l < 4) {
        $("#usernameError").addClass('error');
        $("#usernameError").html('Username gasi nlaw dik htum 4 re ra ai!');
        $("#btn-submit").attr("disabled", "disabled");
    }
    else {
        $.post("../check_username.php", {
            Username: Username.val().trim()
        } , function (data) {
            if (data == 0) {
                //No duplicate entry
                $("#usernameError").removeClass('error');
                $("#usernameError").addClass('green');
                var msg = "Username <span style='font-style: italic'>" + Username.val().trim() + "</span> mai lang ai!";
                $("#usernameError").html(msg);
                $("#btn-submit").removeAttr("disabled");            
            }
            else {
                //Duplicate entry
                $("#usernameError").addClass('error');
                $("#usernameError").html("Username masha ni la da ai! Kaga Username lata ya rit!");
                $("#btn-submit").attr("disabled", "disabled");
            }
        });
    }
}

//function to check for email duplictions
function checkEmail (Email) {

    $.post("../check_email.php", {
        Email: Email.trim()
        }, function(data) {
            if (data == 0) {
                // No duplicate entry
                $("#emailStatus").removeClass('error');
                $("#btn-submit").removeAttr("disabled", "disabled");
            }
            else {
                var msg = "Nang jaw ai email hte account nga ngut sai! ";
                $("#emailStatus").html(msg);
                $("#emailStatus").addClass('error');
                $("#btn-submit").attr("disabled", "disabled");
            }
    });
}

//function to check passwords
function checkPasswords () {
    var Password1 = $('#Password1');
    var Password2 = $('#Password2');
    var l = Password1.val().trim().length;
    if (l < 6) {
        $("#passwordStatus").addClass('error');
        $("#passwordStatus").html('Password gaw nlaw dik htum gasi 6 lawm ra ai!');
        $('#btn-submit').attr("disabled", "disabled");
    }
    else {
        if (Password1.val().trim() != Password2.val().trim()) {
            $('#passwordStatus').addClass('error');
            $('#passwordStatus').html('Lahta na bang ai password hte ya bang ai password nbung ai!');
            $('#btn-submit').attr("disabled", "disabled");
        }
        else {
            $('#passwordStatus').removeClass('error');
            $('#passwordStatus').addClass('green');
            $('#passwordStatus').html('Password ni bung sai!');
            $("#btn-submit").removeAttr("disabled");
        }
    }
}

//function to register
function register() {
    var Username = $('#Username1');
    var Title = $('#Title');
    var Name = $('#Name');
    var Mobile = $('#Mobile');
    var Password1 = $('#Password1');
    var Password2 = $('#Password2');
    var DOB = $('#DOB');
    var Address = $('#Address');
    var Town = $('#Town');
    var State = $('#State');
    var CountryCode = $('#CountryCode');

    Username.removeClass('input-error');
    Title.removeClass('input-error');
    Name.removeClass('input-error');
    Mobile.removeClass('input-error');
    Password1.removeClass('input-error');
    Password2.removeClass('input-error');
    DOB.removeClass('input-error');
    Town.removeClass('input-error');
    State.removeClass('input-error');
    response = $("#response1");

    var inputError = false;
    var errorMsg = "";
    response.removeClass('error');


    if (Username.val().trim() == "") {
        var inputError = true;
        Username.addClass('input-error');
        errorMsg += 'Username bang ya rit! ';
        response.addClass('error');
        response.html(errorMsg);       
    }
    
    if (Title.val() == "") {
        var inputError = true;
        Title.addClass('input-error');
        errorMsg += "Shayi / Shadang lata ya rit! ";
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (Name.val().trim() == "") {
        var inputError = true;
        Name.addClass('input-error');
        errorMsg += "Na amying bang ya rit! "; 
        response.addClass('error');
        response.html(errorMsg);            
    }

    if (Mobile.val().trim() == "") {
        var inputError = true;
        Mobile.addClass('input-error');
        errorMsg += "Na phone number bang ya rit! ";
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (Password1.val().trim() == "") {
        var inputError = true;
        Password1.addClass('input-error');
        Password2.addClass('input-error');
        errorMsg += "Password bang ya rit! ";   
        response.addClass('error');
        response.html(errorMsg);      
    }

    if (DOB.val() == "") {
        var inputError = true;
        DOB.addClass('input-error');
        errorMsg += "Na shangai nhtoi bang ya rit! ";  
        response.addClass('error');
        response.html(errorMsg);        
    }

    if (Town.val().trim() == "") {
        var inputError = true;
        Town.addClass('input-error');
        errorMsg += "Na nga ai mare bang ya rit! ";
        response.addClass('error');
        response.html(errorMsg); 
    }

    if (State.val().trim() == "") {
        var inputError = true;
        State.addClass('input-error');
        errorMsg += "State amying bang ya rit! ";
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (CountryCode.val() == "") {
        var inputError = true;
        CountryCode.addClass('input-error');
        errorMsg += "Mungdan lata ya rit! ";
        response.addClass('error');
        response.html(errorMsg);  
    }    
    
    if (inputError == false) {
        $.ajax({
            method: 'POST', 
            url: "register.php", 
            data: $("#registration-form").serialize(), 
            success: function(data){
                if (data == 0) {
                    //if no error OK is returned
                    alert('Account nnan atsawm sha hpaw lu sai! Login galaw na anhte platform mai lang sai!');
                    window.location.href = 'index.html';
                } 
                if (data == 1) {
                    //1 is returned as connection error!
                    var error = "<span class='error'>Connection hten mat ai! Bai chyam ya rit!</span>";
                    response.html(error);
                }
            }
        });        
    }   
}

//                      ********************* End of functions for resgistration *********************

//                      ********************* Funciton to Update Users Data ************************

//function to update user data
function updateUserData() {
    var Title = $('#Title');
    var Name = $('#Name');
    var Mobile = $('#Mobile');
    var DOB = $('#DOB');
    var Address = $('#Address');
    var Town = $('#Town');
    var State = $('#State');
    var CountryCode = $('#CountryCode');

    Title.removeClass('input-error');
    Name.removeClass('input-error');
    Mobile.removeClass('input-error');
    DOB.removeClass('input-error');
    Town.removeClass('input-error');
    State.removeClass('input-error');
    response = $("#response");

    var inputError = false;
    var errorMsg = "";
    response.removeClass('error');
   
    if (Title.val() == "") {
        var inputError = true;
        Title.addClass('input-error');
        errorMsg += ' Shayi / Shadang lata ya rit! ';
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (Name.val().trim() == "") {
        var inputError = true;
        Name.addClass('input-error');
        errorMsg += " Na a amyin bang ya rit! "; 
        response.addClass('error');
        response.html(errorMsg);            
    }

    if (Mobile.val().trim() == "") {
        var inputError = true;
        Mobile.addClass('input-error');
        errorMsg += " Phone number bang ya rit! ";
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (DOB.val() == "") {
        var inputError = true;
        DOB.addClass('input-error');
        errorMsg += " Shangai nhtoi bang ya rit ";  
        response.addClass('error');
        response.html(errorMsg);        
    }

    if (Town.val().trim() == "") {
        var inputError = true;
        Town.addClass('input-error');
        errorMsg += " Nga ai mare bang ya rit! ";
        response.addClass('error');
        response.html(errorMsg); 
    }

    if (State.val().trim() == "") {
        var inputError = true;
        State.addClass('input-error');
        errorMsg += " State / Division bang ya rit! ";
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (CountryCode.val() == "") {
        var inputError = true;
        CountryCode.addClass('input-error');
        errorMsg += " Mungdan lata ya rit! ";
        response.addClass('error');
        response.html(errorMsg);  
    }

    if (inputError == false) {
        $.ajax({
            url: 'includes/update_user.php',
            type: 'POST',
            data: $("#update-user-form").serialize(),
            success: function(data) {
                if (data == 0) {
                    // zero is returned if there is no errror!
                    var msg = "<span class='green'>Na na lam ni update galaw ngut sai!</span>";
                    response.html(msg);
                }
                if (data == 1) {
                    // 1 is returned if there is a connection error!
                    var errorMsg = "<span class='error'>Connection hte mat ai! Bai chyam ya rit!</span>";
                    response.html(errorMsg);
                }
            },
        });
    }   
}


//                      ********************* Functions for new Post *********************

//function to dispaly preview of an image to be uploaded
function imagePreview(input) {
    if (input.files && input.files[0]) {
        var img = document.getElementById('Image').files[0];
        var imageName = img.name;
        var imageExtension = imageName.split('.').pop().toLowerCase();
        if(jQuery.inArray(imageExtension, ['jpg', 'jpeg']) == -1) {
            alert("Invalid Image Type");
            $("#btn-submit").attr('disabled', 'disabled');
        }

        else {
            $("#btn-submit").removeAttr('disabled');
            var imagePv = new FileReader();
            imagePv.onload = function (e) {
                $("#image_preview").attr('src', e.target.result);                
            };              
        }

        var imageSize = img.size;
        if (imageSize > 12000000) {
            alert("Image is too large!");
            $("#btn-submit").attr('disabled', 'disabled');      
        }
        
        imagePv.readAsDataURL(input.files[0]);   
    }

}

function preview() {
    $("#images").on('change', function(e) {
        var files = e.target.files;

        $.each(files, function(i, file){
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e) {
                var template = '<img scr="'+e.target.result+'">';
                $(".image_preview").append(template);
            };
        }); 
    });
}

//function to get tags 
function getTags (selectedId) {
    $.post("includes/select_tags.php", {
        selectedId: selectedId
        }, function(data) {
            $("#TagsId").append(data);
    });
}

//function to insert new post
function insertNewPost() {
    var fdata = new FormData();
    var files = $("#Image")[0].files[0];
    fdata.append('Image', files);

    var Title = $("#Title");
    var Description = $("#Description");
    var TagsId = $("#TagsId");

    if (Title.val() == "") {
        $("#btn-submit").attr('disabled', 'disabled');
        Title.addClass("input-error");
        alert('Chyeju hte gabaw bang ya rit!');
    }

    else {
        Title.removeClass("input-error");
        var url = "includes/insert_post.php?Title=" + Title.val().trim() + "&Description=" + Description.val().trim() + "&TagsId=" + TagsId.val();
        
        $.ajax({
            url: url,
            type: 'post',
            data: fdata,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 0) {
                    // zero is returned if there is no error!
                    Toggle('new-post');
                    // reloadPosts('select_posts.php');
                    location.reload();
                    alert('Na na post hpe lu mara sai!');
                }
                else {
                    // 1 us retured if there is an error!
                    alert ("Connection hten mat ai! Bai chyam ya rit!");
                    reloadPosts('select_posts.php');
                }
            }
        });
    }
}

function reloadPosts (source) {
    var sorting = $("#sorting").val();
    var search = $("#search").val().trim();
    var limit = $("#limit").val();
    
    checkForRemainingData ();

    $.post ('includes/' + source, {
        sorting: sorting,
        search: search,
        limit: limit
        }, function(data) {
            $("#posts-data").html(data);
        }
    );
}

function deletePost(id) {
    var r = confirm("Ndai post hte delete galaw na sai i? Delete galaw ngut ai hpang bai nmai mu sai!");
    if (r == true) {
        $.post ('includes/delete_post.php', {
            Id: id
            }, function (data){
                if (data == 0) {
                    reloadPosts('my_posts.php');
                }
                else {
                    alert("Connection hten mat ai! Bai chyam ya rit!");
                }                
            }
        );
    }
}

function checkForRemainingData () {
    var i = $("#remaining-data").html();
    if (i <= 0) {
        $("#btn-load-more").attr('disabled', 'disabled');
        $("#btn-load-more").html('Ndai ram sha re sai!');
    }
    else {
        $("#btn-load-more").removeAttr('disabled', 'disabled');
        $("#btn-load-more").html('Naw Yu na');
    }
}

//function to bookmark a post
function bookmarkPost (PostsLink) {
	
	$.post("includes/bookmark_post.php", {
		PostsLink: PostsLink
		}, function (data) {
			
			if (data == 0) {
				// Zero is returned if there is no error!
                var msg = "Ndai post hpe nang na matsing da ai jahpan kaw bang da sai!"
				alert(msg);
			}
	
			if (data == 1) {
				// One is returned for connection error!
				var errorMsg = "Connection hten mat ai! Bai chyam ya rit!";
				alert(errorMsg);
			}
		}
	);
}

// function to remove bookmark
function removeBookmark (BookmarksId) {
    $.post('includes/remove_bookmark.php', {
        BookmarksId: BookmarksId
    }, function(data){
        
        if (data == 0) {
            var msg = 'Ndai post hpe na na matsing da ai jahpan kaw na shaw kau sai!';
            alert(msg);
        }

        if (data == 1) {
            var errorMsg = 'Connection hten mat ai! Bai chyam ya rit!';
            alert(errorMsg);
        }
        reloadPosts('my_bookmarks.php');
    });
}

function markAsSoldOut (Id) {
    $.post ("includes/mark_as_sold_out.php", {
        Id: Id
    }, function (data) {

        if (data == 0) {
            var msg = "Post hpe update galaw lu sai!";
            alert(msg);
            reloadPosts('my_posts.php'); 
        }

        if (data == 1) {
            var errorMsg = "Connection hten mat ai! Bai chyam ya rit!";
            alert(errorMsg);
            reloadPosts('my_posts.php');
        }        
    });
}   


//                      ********************* End of functions for new Post *********************



//                      ********************* Function for comments *********************

function postComment (Id, source) {
    var Comment = $("#Comment" + Id).html().trim();
    if (Comment == "") {
        alert("Post mara na hpa nnga ai!");
    }
    else {
        $.post("includes/insert_comment.php", {
            Comment: Comment,
            PostsId: Id
            }, function (data) {
                
                if(data == 0) {
                    reloadPosts (source);
                }
                if (data == 1) {
                    alert('Connection hten mat ai! Bai chyam ya rit!');
                    reloadPosts (source);
                }
            }
        
        );
    }
}

function insertReply (Id, source) {
    var Reply = $("#Reply"+ Id).html().trim();
    $.post ("includes/insert_reply.php", {
            Message: Reply,
            CommentsId: Id
        }, function (data) {
                
            if (data == 0) {
                reloadPosts (source);
            }
            if (data == 1) {
                alert('Connection hten mat ai! Bai chyam ya rit!');
                reloadPost (source);
            }
        } 
    );
}

//                      ********************* End of fucntions for comments *********************


function deleteMessage (Link) {
    var r = confirm("Ndai laika hpe delete galaw na sai i?");
    if (r == true) {
       window.location.href = 'includes/delete_message.php?MessagesLink=' + Link;
    }
}

function replyMessage (ReceiversLink) {
    var Subject = $("#Subject").html().trim();
    var Message = $("#Message").html().trim();
    var ConversationId = $("#ConversationId").val().trim();
    
    $.post("includes/reply_message.php", {
        Subject: Subject, 
        Message: Message, 
        ConversationId: ConversationId,
        ReceiversLink: ReceiversLink
        }, function (data) {
            if (data == 0) {
                alert('Your message was successfully sent!');
                window.location.href = 'my_inbox.html';
            }
            else {
                alert('Connection hten mat ai! Bai chyam ya rit!');
            }
    });
}

// function to load messages 
function loadMessages (source) {
    var sorting = $("#sorting").val()
    var search = $("#search").val().trim();
    var limit = $("#limit").val();

    checkForRemainingData ();

    $.post ("includes/" + source, {
        sorting: sorting,
        search: search, 
        limit: limit
        }, function (data) {
            $("#Messages-data").html(data);
            // alert(data);
    });
}

function postCommentOnePost(PostsId) {
    var Comment = $("#Comment" + PostsId).html().trim();
    
    $.post("includes/insert_comment.php", {
        Comment: Comment,
        PostsId: PostsId
        }, function (data) {
            if (data == 0) {
                location.reload(true);
            }
            if (data == 1) {
                alert('Connection hten mat ai! Bai chyam ya rit!');
                location.reload(true);
            }
    });
}

function insertReplyOnePost (CommentsId) {
    var Reply = $("#Reply" + CommentsId).html().trim();
    
    $.post('includes/insert_reply.php', {
        Message: Reply, 
        CommentsId: CommentsId
        }, function (data) {
            if (data == 0) {
                location.reload(true);
            }

            if (data == 1) {
                alert('Connection hten mat ai! Bai chyam ya rit!');
                location.reload(true);
            }
    });
}

function deleteNotification (Link) {
    $.post('includes/delete_notification.php', {
        Link: Link
        }, function (data) {
            if (data == 0) {
                location.reload(true);
            }
            else {
                alert('Connection hten mat ai! Bai chyam ya rit!');
                location.reload(true);
            }
    });
}
