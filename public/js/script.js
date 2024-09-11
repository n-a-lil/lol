function showLoginForm() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("form-container").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/showLoginForm', true);
    xhttp.send();
}

function showRegistrationForm() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("form-container").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/showRegistrationForm', true);
    xhttp.send();
}
function logout() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            window.location.href = "/vkbot"; 
        }
    };
    xhttp.open('GET', '/logout', true);
    xhttp.send();
}

function showMyAccount() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/myAccount', true);
    xhttp.send();
}

function editMode() {
    document.getElementById("editForm").style.display = "block";
    document.getElementById("editButton").style.display = "none";
    document.getElementById("userData").style.display = "none";
}

function saveChanges(userId) {
    var name = document.getElementsByName("name")[0].value;
    var surname = document.getElementsByName("surname")[0].value;
    var email = document.getElementsByName("email")[0].value;
    var age = document.getElementsByName("age")[0].value;

    var url = '/edit/' + userId + '?name=' + encodeURIComponent(name) + '&surname=' + encodeURIComponent(surname) + '&email=' + encodeURIComponent(email) + '&age=' + encodeURIComponent(age);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4) {
            if (xhttp.status == 200) {
                showMyAccount();
            } else {
                console.error("Error:", xhttp.status);
            }
        }
    };
    xhttp.open('GET', url, true);
    xhttp.send();
}

function showAllFriends() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/friends', true);
    xhttp.send();
}

function showMyFriends() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/myFriends', true); 
    xhttp.send();
}

function searchFriends() {
    var searchInput = document.getElementById("friend-search").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("friend-results").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/searchFriends?search=' + searchInput, true);
    xhttp.send();
}

function searchMyFriends() {
    var searchInput = document.getElementById("friend-search").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("friend-results").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/searchMyFriends?search=' + searchInput, true);
    xhttp.send();
}

function showNotifications() {
    var xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        if (xhttp.status === 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        } else {
            console.error('Request failed. Status:', xhttp.status);
        }
    };
    xhttp.onerror = function () {
        console.error('Request failed');
    };
    xhttp.open('GET', '/notifications', true);
    xhttp.send();
}

function addFriend(senderId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            showNotifications();
        } else if (xhttp.readyState == 4 && xhttp.status != 200) {
            console.error('Error:', xhttp.status);
        }
    };
    xhttp.open('GET', '/addFriend/' + senderId, true);
    xhttp.send();
}

function rejectFriend(notificationId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            showNotifications();
        } else if (xhttp.readyState == 4 && xhttp.status != 200) {
            console.error('Error:', xhttp.status);
        }
    };
    xhttp.open('GET', '/rejectFriend/' + notificationId, true);
    xhttp.send();
}

function showUserProfile(userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        } else if (xhttp.readyState == 4 && xhttp.status != 200) {
            console.error('Error:', xhttp.status);
        }
    };
    xhttp.open('GET', '/user/' + userId, true);
    xhttp.send();
}

function addToFriend(userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            showAllFriends();
        } else if (xhttp.readyState == 4 && xhttp.status != 200) {
            console.error('Error:', xhttp.status);
        }
    };
    xhttp.open('GET', '/addToFriend/' + userId, true);
    xhttp.send();
}

function cancelFriendRequest(userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            alert("Запрос на добавление в друзья отменен!");
        } else if (xhttp.readyState == 4 && xhttp.status != 200) {
            console.error('Error:', xhttp.status);
        }
    };
    xhttp.open('GET', '/cancelFriendRequest/' + userId, true);
    xhttp.send();
}

function removeFromFriends(friendId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            showMyFriends();
        } else if (xhttp.readyState == 4 && xhttp.status != 200) {
            console.error('Ошибка:', xhttp.status);
        }
    };
    xhttp.open('GET', '/removeFromFriends/' + friendId, true);
    xhttp.send();
}

function showMessages() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        } else if (xhttp.readyState == 4 && xhttp.status != 200) {
            console.error('Error:', xhttp.status);
        }
    };
    xhttp.open('GET', '/messages', true);
    xhttp.send();
}

function showDialog(userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        } else if (xhttp.readyState == 4 && xhttp.status != 200) {
            console.error('Error:', xhttp.status);
        }
    };
    xhttp.open('GET', '/messagesDialog/' + userId, true);
    xhttp.send();
}

function addMessage(userId) {
    var messageText = document.getElementById("message-text").value;
    var url = '/sendMessage/' + userId + '?text=' + encodeURIComponent(messageText);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
                showDialog(userId);
            } else {
                console.error('Error:', xhttp.status);
        }
    };
    xhttp.open('GET', url, true);
    xhttp.send();
}

function showMusic() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/showMusic', true);
    xhttp.send();
}

function showAllMusic() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/showAllMusic', true);
    xhttp.send();
}

function searchAllMusic() {
    var searchInput = document.getElementById("music-search").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("music-results").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/searchAllMusic?search=' + searchInput, true);
    xhttp.send();
}

function searchMyMusic() {
    var searchInput = document.getElementById("music-search").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("music-results").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/searchMyMusic?search=' + searchInput, true);
    xhttp.send();
}

function showPosts() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/showPosts', true);
    xhttp.send();
}

function addPosts() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/addPosts', true);
    xhttp.send();
}

function addPost() {
    var title = document.getElementById("title").value;
    var text = document.getElementById("text").value;
    var image = document.getElementById("image").files[0].name;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        }
        addPosts();
    };
    xhttp.open('GET', '/addPost?title=' + title + '&text=' + text + '&image=' + image, true);
    xhttp.send();
}

function showPost(postId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("main-content").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('GET', '/post/' + postId, true);
    xhttp.send();
}

function likePost(postId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("like-count").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "/likePost?post_id=" + postId, true);
    xhttp.send();
}

function addComment(postId) {
    var commentText = document.getElementById("comment_text").value.trim();
    if (commentText === "") {
        alert("Введите текст комментария!");
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            showPost(postId)
        }
    };
    xhttp.open("GET", "/addComment/" + postId + "?comment_text=" + encodeURIComponent(commentText), true);
    xhttp.send();
}