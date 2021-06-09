# Crypto 100 - Security Obscurity

## Challenge Text:

We received 85 messages from an operative we have in the field. We don't think it's encrypted, but we can't figure out the encoding... can you help us? 

Here is one message:

`F(oH)@rH73<+n(.1K#oKBJX[NH#PQ\DalO#@rGmlDJ+@` 

## Hints:

Theres Base64, but there's also base`num`

## How to solve: 

This challenge is solved by taking the text and putting it into a base85 decoder. The text is not encrypted, but instead encoded. Meaning that it can be made readable by just decoding it. 