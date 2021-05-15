package main

import (
    "fmt"
	"os"
  "syscall"
  "time"
)

const (
  ATTACH_PARENT_PROCESS = ^uint32(0) // (DWORD)-1
)

var (
  modkernel32 = syscall.NewLazyDLL("kernel32.dll")

  procAttachConsole = modkernel32.NewProc("AllocConsole")

)

func AllocConsole(dwParentProcess uint32) (ok bool) {
  r0, _, _ := syscall.Syscall(procAttachConsole.Addr(), 1, uintptr(dwParentProcess), 0, 0)
  ok = bool(r0 != 0)
  return
}

func main() {

  ok := AllocConsole(ATTACH_PARENT_PROCESS)
  if ok {
    fmt.Println("Attached")
  }
	nono := 

	`
	   		  ...------------._
                         ,-'                   '-.
                      ,-'                         '.
                    ,'                            ,-'.
                   ;                              '-' '.
                  ;                                 .-. \
                 ;                           .-.    '-'  \
                ;                            '-'          \
               ;                                          '.
               ;                                           :
              ;                                            |
             ;                                             ;
            ;                            ___              ;
           ;                        ,-;-','.'.__          |
       _..;                      ,-' ;','.','.--'.        |
      ///;           ,-'   '. ,-'   ;' ;',','_.--=:      /
     |'':          ,'        :     ;' ;,;,,-'_.-._'.   ,'
     '  :         ;_.-.      '.    :' ;;;'.ee.    \|  /
      \.'    _..-'/8o. '.     :    :! ' ':8888)   || /
       ||'-''    \\88o\ :     :    :! :  :'""'    ;;/
       ||         \"88o\;     '.    \ '. '.      ;,'
       /)   ___    '."'/(--.._ '.    '.'.  '-..-' ;--.
       \(.="""""==.. ''-'     '.|      '-'-..__.-' '. '.
        |          '"==.__      )                    )  ;
        |   ||           '"=== '                   .'  .'
        /\,,||||  | |           \                .'   .'
        | |||'|' |'|'           \|             .'   _.' \
        | |\' |  |           || ||           .'    .'    \
        ' | \ ' |'  .   ''-- '| ||         .'    .'       \
          '  |  ' |  .    ''-.._ |  ;    .'    .'          '.
       _.--,;'.       .  --  ...._,'   .'    .'              '.__
     ,'  ,';   '.     .   --..__..--'.'    .'                __/_\
   ,'   ; ;     |    .   --..__.._.'     .'                ,'     '.
  /    ; :     ;     .    -.. _.'     _.'                 /         '
 /     :  '-._ |    .    _.--'     _.'                   |
/       '.    '--....--''       _.'                      |
          '._              _..-'                         |
             '-..____...-''                              |
                                                         |
                                                         |

		It's A Trap!

	`


    
	
	flag := "silicon{SometimesStringsIsBetterthanIDA}"

	filename := "sparrow.sh"

    if (Exists(filename)){
		fmt.Println(flag)
	} else {
		fmt.Println(string(nono))
	}

  time.Sleep(30 * time.Second)



}

func Exists(name string) bool {
    if _, err := os.Stat(name); err != nil {
        if os.IsNotExist(err) {
            return false
        }
    }
    return true
}

