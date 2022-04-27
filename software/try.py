my_str = "the one bumble bee one bumble the bee"
my_str2 = "Ask not what your country can do for you ask what you can do for your country"
result = "01231203"
def format_sentence(sentence):
    sentence = sentence.lower()
    print(sentence)
    my_list = sentence.split()
    my_dict = {}
    char = 0
    for i in my_list:
        if i not in my_dict:
            my_dict[i] = char
            char += 1
    res = ""
    for i in my_list:
        res += str(my_dict.get(i))
    return(res)
print(format_sentence(my_str2))