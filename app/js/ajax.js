import { header } from "./components/header.js";
import { single } from "./components/single.js";

//That e is the event parameter
document.addEventListener("DOMContentLoaded", loadlist)
function loadlist() {
    //We instantiate xhr to XMLHttpRequest::class because we need to call the following methods.
    const xhr = new XMLHttpRequest();
    //First we using the method open() so we can define the Http request(GET in our case) and URI.
    xhr.open("GET", "/listusers")
    //Second we using the method send() which we sending the request
    xhr.send();
    //Onload method change the ready state and the browser recieves the response.
    xhr.onload = function () {
        //The html variable is basicly the data that will get printed on the page.
        // No type declaration = global variable.
        var html = header()
        // JSON.parse so we can translate from JSON to Java Script.
        // responseText is what is coming from the php JSON
        var users = JSON.parse(this.responseText)
        // for loop so we can get our values.
        for (let i = 0; i < users.length; i++) {
            html += `<tr>
                     <td>${users[i].first_name}</td>
                     <td>${users[i].last_name}</td>
                     <td>${users[i].email}</td>
                     <td><a data-id="${users[i].id}" data-button="WildCard" class="myButton ajaxButton">Wild Card</a></td>
                     <td><a data-id="${users[i].id}" data-button="FetchAPI" class="myButton ajaxButton">Fetch API</a></td>
                     <td><a data-id="${users[i].id}" data-button="QueryString" class="myButton ajaxButton">Query String</a></td>
                  </tr>`
        }
        // Append to the HTML document.
        var tags = document.getElementsByTagName('table')[0].innerHTML = html;
        Array.from(document.getElementsByClassName('ajaxButton')).forEach(button => {
            button.addEventListener('click', function () {
                switch (this.getAttribute('data-button')) {
                    case "WildCard":
                        loadsingle(this.getAttribute('data-id'))
                        break
                    case "FetchAPI":
                        loadsingleQ(this.getAttribute('data-id'))
                        break
                    case "QueryString":
                        loadsingleFetchAPI(this.getAttribute('data-id'))
                        break
                }//Switch
            }//addEventListener Callback
            )//addEventListener Parenthesis
        }//forEach Callback
        )//forEach
    }//onload
}//loadlist


//Using XMLHttpRequest.
//This function is the same as the function loadsingleFetchAPI(id)!
function loadsingle(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/listuser/" + id)
    xhr.send();
    xhr.onload = function () {
        var html = header()
        var users = JSON.parse(this.responseText)
        html += single(users)
        var tags = document.getElementsByTagName('table')[0].innerHTML = html;
        document.getElementById("listButton").addEventListener("click", loadlist)
    }
}

// Q from query_string
function loadsingleQ(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/listuser?id=" + id)
    xhr.send();
    xhr.onload = function () {
        var html = header()
        var users = JSON.parse(this.responseText)
        html += single(users)
        var tags = document.getElementsByTagName('table')[0].innerHTML = html;
        document.getElementById("listButton").addEventListener("click", loadlist)
    }
}

//Using fetch.
//This function is the same as the function loadsingle(id)!
function loadsingleFetchAPI(id) {
    fetch("/listuser/" + id)
        .then(function (response) {
            return response.json()
        })
        .then(function (users) {
            var html = header()
            html += single(users)
            var tags = document.getElementsByTagName('table')[0].innerHTML = html;
            document.getElementById("listButton").addEventListener("click", loadlist)
        })
}