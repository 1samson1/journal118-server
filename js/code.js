window.onload = function () {   

    var check = document.getElementById("query")
    var answer = document.getElementById("response")

   
    check.onclick = function () {
        sendQuery('/api/reg.php','POST',{
            name:'Артём',
            surname:'Синотов',
            login:'Sinot',
            email:'dsdhsjkf@fdsfsk.ru',
            pass:'12345',
            repass:'12345',
        }).then(awr => print(awr,answer))
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
            console.log(response)
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