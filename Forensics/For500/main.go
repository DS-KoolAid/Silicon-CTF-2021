package main

import (
	"time"
	"fmt"
	"strconv"
	"io/ioutil"
    "net/http"
	"crypto/md5"
    "encoding/hex"
)


func main(){
	dt_int := time.Now().Unix()
	dt_str := strconv.FormatInt(dt_int,10)
	auth := create_sig(dt_str)
	send_GET(dt_str, auth)

}


func create_sig(dt string) string {
	
	hard_coded_string := "ai2@9fC31#59a!la{a"
	fmt.Println("This is the string to be hashed: "+dt+hard_coded_string)
	auth_sig_pre := dt+hard_coded_string
	auth_sig_hash := md5.Sum([]byte(auth_sig_pre))
	auth_sig := hex.EncodeToString(auth_sig_hash[:])
	fmt.Println("This is the hash: "+ auth_sig)
	return auth_sig
}

func send_GET(auth_ts string, auth_sig string)[]byte {

	client := &http.Client{}
	req, _ := http.NewRequest("GET", "http://localhost:8080/c2", nil)
	req.Header.Set("auth_timestamp",auth_ts)
	req.Header.Set("auth_signature",auth_sig)
	res, _ := client.Do(req)

	defer res.Body.Close()

	body, err := ioutil.ReadAll(res.Body)
    if err != nil {
        print(err)
    }

	fmt.Printf("%s\n",body)

	return body

}
