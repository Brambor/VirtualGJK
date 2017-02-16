function getContent(keyword, callFunction, parserFunction){
    var request;
    if(window.XMLHttpRequest){
        request = new XMLHttpRequest;
    }else if(window.ActiveXObject){
        request = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        return;
    }

    request.onreadystatechange = function(){
        if(request.readyState === 4){
            try{
                parserFunction(keyword, request.responseText);
            }catch(e){
                console.log(e);
            }
        }
    };

    request.open("GET", callFunction(keyword));
    request.send(null);
}

function getImages(keyword){
    getContent(keyword, imageCallFunction, imageParserFunction);
}

function mapParserFunction(keyword, response){
    document.getElementById('mapDIV').innerHTML = response;
    document.getElementById('mapDIV').setAttribute("map-name", keyword);
    display('mapDIV', 'content');
}

function imageParserFunction(keyword, response){
    try{
        response = JSON.parse(response);
        if(response.length == 0){
            return;
        }
    }catch(e){
        console.log(e);
    }

    keys = Object.keys(response);
    key = findNewestDate(keys);
    newestDate = response[key];
    document.getElementById('imageDIV').innerHTML = "";

    for (var i in newestDate) {
        a = createA(keyword, key, newestDate[i]);
        a.appendChild(createIMG(keyword, key, newestDate[i]));
        li = document.createElement('li');
        li.appendChild(a);
        document.getElementById('imageDIV').appendChild(li);
    }

    $(document).ready(function() {
        $.piroBox_ext({
            piro_speed :700,
            bg_alpha : 0.8,
            piro_scroll : true,
            piro_drag :false,
            piro_nav_pos: 'bottom'
        });
    });

    display('imageDIV', 'content');
}

function mapCallFunction(keyword){
    return "./Map/" + keyword + ".xml";
}

function imageCallFunction(keyword){
    return "files.php?room=" + keyword;
}

/*
 * SET UP DYNAMIC IMAGES
 */
function createIMG(keyword, key, a){
    img = document.createElement('img');
        img.src = "./Rooms/" + keyword + "/" + key + "/" + a;
        img.style.height = "90px";
        img.style.width = "120px";
    return img;
}

function createA(keyword, key, b){
    a = document.createElement('a');
        a.setAttribute('href', "./Rooms/" + keyword + "/" + key + "/" + b);
        a.setAttribute('rel', 'gallery');
        a.setAttribute('class', 'pirobox_gall');
    return a;
}

/*
 * FIND NEWEST DATE ARRAY
 */
var highestDateParsed = null;
var highestDate = null;
function findNewestDate(array){
    for(var i = 0; i < array.length; i++){
        var date = new Date(array[i]);
        if(highestDateParsed < date || highestDateParsed === null){
            highestDateParsed = date;
            highestDate = array[i];
        }
    }
    return highestDate;
}

/*
 * CHANGE OF DISPLAY VALUE > ALL CLASS DISPLAY NONE, TARGET_ID DISPLAY BLOCK
 */
function display(targetDIV, targetClass){
    classes = document.getElementsByClassName(targetClass);
    for(var i = 0; i < classes.length; i++){
        classes[i].style.display = "none";
    }

    document.getElementById(targetDIV).style.display = "block";
    if(targetDIV === "mapDIV"){
        if(document.getElementsByClassName('piro_overlay')[0] != null)
            document.body.removeChild(document.getElementsByClassName('piro_overlay')[0]);
        if(document.getElementsByClassName('piro_html')[0] != null)
        document.body.removeChild(document.getElementsByClassName('piro_html')[0]);
    }
}

/* 
 * EXTENSION JAVASCRIPT LIBRARY
 */
Object.keys = function(o) {
    var k=[],p;
    for (p in o) if (Object.prototype.hasOwnProperty.call(o,p)) k.push(p);
    return k;
};