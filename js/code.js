window.onload = function () {   

    var check = document.getElementById("query")
    var url = document.getElementById("url")
    var template = document.getElementById("template")
    var answer = document.getElementById("response")
    var body 


    url.value = 'http://journal118/api/login.php' 
    template.value = '2' 
    

    check.onclick = function () {
        switch (parseInt(template.value)) {
            case 1:
                body = {
                    name:'Артём',
                    surname:'Синотов',
                    login:'Sinot',
                    email:'dsdhsjkf@fdsfsk.ru',
                    pass:'12345',
                    repass:'12345',
                }
                break;
            case 2:
                body = {            
                    login:'Sinot',           
                    pass:'12345',            
                }
                break;  
                
            case 3:
                body = { 
                    token:'$2y$10$P35ZKiTY2cG0eC/ihxSzquplw4dPRlxy8N4vKA68vKRknd4KYPIZy',            
                }
                break; 
        
            default:
                break;
        }

        sendQuery(url.value,'POST',body).then(awr => print(awr,answer))
        .catch(error => console.error(error))
    }
}

function sendQuery(url,method,body) {
    return fetch(url,{
        method,
        body:JSON.stringify(body),
        headers:{
            'Content-Type':'application/json'
        }
    }).then(response => {
        return new Promise((resolve,reject) => {            
            if(response.ok){
                resolve(response.json())
            }
            reject({
                error:true,
                error_num:322,
                error_info:'Что-то пошло не так',
            })
        })
    })
}

function print(message,stream) {
    stream.innerHTML = JSON.stringify(message)
    console.log(message)
}