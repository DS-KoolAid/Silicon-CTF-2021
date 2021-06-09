

mapping = {
    "a":"y",
    "b":"q",
    "c":"e",
    "d":"w",
    "e":"t",
    "f":"o",
    "g":"u",
    "h":"r",
    "i":"p",
    "j":"i",
    "k":"a",
    "l":"k",
    "m":"l",
    "n":"h",
    "o":"d",
    "p":"s",
    "q":"z",
    "r":"g",
    "s":"j",
    "t":"f",
    "u":"m",
    "v":"v",
    "w":"n",
    "x":"c",
    "y":"b",
    "z":"x"}
def encypt():
    s=''
    with open('note','r') as f:
        for i in f:
            for j in i: 
                j=j.lower()
                if j in mapping:
                    s+=mapping[j]
                else:
                    s+=j
    with open('out','w') as f:
        f.write(s)

def freq_analysis():
    alpha = {}
    with open('note','r') as f:
        for i in f:
            for j in i:
                j=j.lower()
                if j == ' ':
                    continue
                elif j not in alpha:
                    alpha[j]=1
                else:
                    alpha[j]+=1
    print(sorted(alpha.items(), key=lambda item: item[1]))
    # for i in sorted(alpha):
    #     print(f"{i}:{alpha[i]}\n")
                
    
def decrypt():
    s=''
    with open('out','r') as f: 
        for i in f:
            for j in i:
                found = False
                for orig,cipher in mapping.items():
                    if cipher==j:
                        s+=orig
                        found=True
                        break
                if found==False:
                    s+=j
    print(s)

freq_analysis()