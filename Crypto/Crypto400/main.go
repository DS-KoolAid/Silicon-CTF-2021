package main

import (
	"crypto/rand"
	"crypto/rsa"
	"crypto/sha512"
	"crypto/x509"
	"encoding/pem"
	"fmt"
	"io/ioutil"
	"os"

	"golang.org/x/crypto/salsa20"
)

var key = [32]byte{}
var nonce = [8]byte{}

func check(e error) {
	if e != nil {
		panic(e)
	}
}

func PublicKeyToBytes(pub *rsa.PublicKey) []byte {
	pubASN1, err := x509.MarshalPKIXPublicKey(pub)
	if err != nil {
		check(err)
	}

	pubBytes := pem.EncodeToMemory(&pem.Block{
		Type:  "RSA PUBLIC KEY",
		Bytes: pubASN1,
	})

	return pubBytes
}

func BytesToPublicKey(pub []byte) *rsa.PublicKey {
	block, _ := pem.Decode(pub)
	enc := x509.IsEncryptedPEMBlock(block)
	b := block.Bytes
	var err error
	if enc {
		fmt.Println("is encrypted pem block")
		b, err = x509.DecryptPEMBlock(block, nil)
		if err != nil {
			check(err)
		}
	}
	ifc, err := x509.ParsePKIXPublicKey(b)
	if err != nil {
		check(err)
	}
	key, ok := ifc.(*rsa.PublicKey)
	if !ok {
		fmt.Println("not ok")
	}
	return key
}

func PrivateKeyToBytes(priv *rsa.PrivateKey) []byte {
	privBytes := pem.EncodeToMemory(
		&pem.Block{
			Type:  "RSA PRIVATE KEY",
			Bytes: x509.MarshalPKCS1PrivateKey(priv),
		},
	)

	return privBytes
}

func GenerateKeyPair(bits int) (*rsa.PrivateKey, *rsa.PublicKey) {
	privkey, err := rsa.GenerateKey(rand.Reader, bits)
	if err != nil {
		check(err)
	}
	return privkey, &privkey.PublicKey
}

func EncryptWithPublicKey(msg []byte, pub *rsa.PublicKey) []byte {
	hash := sha512.New()
	ciphertext, err := rsa.EncryptOAEP(hash, rand.Reader, pub, msg, nil)
	if err != nil {
		check(err)
	}
	return ciphertext
}

func make_key() []byte {
	key := make([]byte, 32)
	_, err := rand.Read(key)
	check(err)
	fmt.Println(key)
	return key
}

func main() {
	temp_key := make_key()
	copy(key[:], temp_key)
	fmt.Println(key)
	data, err := ioutil.ReadFile("Darkside_flag.png")
	check(err)
	priv, pub := GenerateKeyPair(2048)
	EncryptWithPublicKey(temp_key, pub)
	out := make([]byte, len(data))
	salsa20.XORKeyStream(out, data, nonce[:], &key)
	f, err2 := os.OpenFile("encrypted_Darkside_flag.jpeg", os.O_APPEND|os.O_CREATE|os.O_WRONLY, 0644)
	check(err2)
	f.Write([]byte("key:"))
	f.Write(key[:])
	f.Write([]byte("data:"))
	f.Write(out)
	f.Close()
	data2, err4 := ioutil.ReadFile("the_next_jedi.jpeg")
	check(err4)
	out2 := make([]byte, len(data2))
	salsa20.XORKeyStream(out2, data2, nonce[:], &key)
	f2, err3 := os.OpenFile("encrpted_the_next_jedi.jpeg", os.O_APPEND|os.O_CREATE|os.O_WRONLY, 0644)
	check(err3)
	f2.Write([]byte("key:"))
	f2.Write(key[:])
	f2.Write([]byte("data:"))
	f2.Write(out)
	f2.Close()
	err = ioutil.WriteFile("private_key.pem", PrivateKeyToBytes(priv), 0644)

	// err = ioutil.WriteFile("encrypted.jpeg",out,0644)
	// check(err)
	// data2, err3 := ioutil.ReadFile("encrypted.jpeg")
	// check(err3)
	// out2 := make([]byte, len(data))
	// salsa20.XORKeyStream(out2, data2, nonce[:], &key)
	// err4 := ioutil.WriteFile("decrypted.jpeg",out2,0644)
	// check(err4)
	// priv,pub := GenerateKeyPair(2048)
	// fmt.Println(PrivateKeyToBytes(priv))
	//
	// test := PublicKeyToBytes(pub)
	// fmt.Println(test)
	// fmt.Println(BytesToPublicKey(test))
	// err = ioutil.WriteFile("encypted_key",EncryptWithPublicKey(temp_key,pub),0644)
}
