
#!/usr/bin/env python
# -*- coding: utf-8 -*-
import sys
sys.stdout.reconfigure(encoding='utf-8')


# The following algorithm is based on the description in https://feldarkrealms.com/
# Their algorithm splits words into "chunks" of length 3 and generates words by putting them together
# This program uses a chunk length of 2, 3 or 4 as inputted with the commandline arguments. It takes into account the beginnings and endings of words to make them more realistic than the source algorithm


# chunk_length = 3 # the length of chunks to be analyzed. 3 or 4 is probably best (for medium length words)
# output_length = 100 # how many words to generate
if sys.argv[1] == "2":
    chunk_length = 2
elif sys.argv[1] == "3":
    chunk_length = 3
elif sys.argv[1] == "4":
    chunk_length = 4
else:
    raise Exception("virknes garumam jābūt no 2 līdz 4")
# chunk_length = int(sys.argv[1]) # the length of chunks to be analyzed
output_length = int(sys.argv[2]) # how many words to generate


import csv
import random
import copy
import numpy as np
import matplotlib.pyplot as plt

# load words from saraksts_references_minimal.csv
with open('.\generator\saraksts_references_minimal.csv', encoding='utf-8') as f:
    reader = csv.reader(f)
    raw_data = list(reader)
raw_data = [x[0] for x in raw_data] # remove the top dimension

# alphabet_length = 33
alphabet_length = 35
# the dictionary to convert a string into a list of numbers
alphabet_to_index = {'a':1,'ā':2,'b':3,'c':4,'č':5,'d':6,'e':7,'ē':8,'f':9,'g':10,'ģ':11,'h':12,'i':13,'ī':14,'j':15,'k':16,'ķ':17,'l':18,'ļ':19,'m':20,'n':21,'ņ':22,'o':23,'p':24,'r':25,'s':26,'š':27,'t':28,'u':29,'ū':30,'v':31,'z':32,'ž':33,'-':34}
# the alphabet used to convert numerical representations of letters into text
index_to_alphabet = ['','a','ā','b','c','č','d','e','ē','f','g','ģ','h','i','ī','j','k','ķ','l','ļ','m','n','ņ','o','p','r','s','š','t','u','ū','v','z','ž','-']

# def ind_to_string(indexes):# ind_to_string([1,2,3])=="aāb"
#     return ''.join(list(map(lambda index: index_to_alphabet[index], indexes)))
# def string_to_ind(str):# string_to_ind("aāb")==[1,2,3]
#     return list(map(lambda c: alphabet_to_index[c], [*str]))
# def pad_list(l, target_length, value=0):
#     for i in range(len(l), target_length):
#         # print("agds")
#         l.append(value)
#     return l


chunk_dict = {}
# print("Virkņu garums =", chunk_length)

data_with_ends = [(chunk_length-1)*"^"+word+"$" for word in raw_data]

# an alphabet that also has characters for something before the beginning of a word and something after the end
special_alphabet = ['a','ā','b','c','č','d','e','ē','f','g','ģ','h','i','ī','j','k','ķ','l','ļ','m','n','ņ','o','p','r','s','š','t','u','ū','v','z','ž','-','^','$']# ('^' for beginning of word, '$' for end)

# generate an empty chunk_dict with all combinations of chunk_length letters as entries
if chunk_length==2:
    for l1 in special_alphabet:
        for l2 in special_alphabet:
            chunk_dict[l1+l2]=0
elif chunk_length==3:
    for l1 in special_alphabet:
        for l2 in special_alphabet:
            for l3 in special_alphabet:
                chunk_dict[l1+l2+l3]=0
elif chunk_length==4:
    for l1 in special_alphabet:
        for l2 in special_alphabet:
            for l3 in special_alphabet:
                for l4 in special_alphabet:
                    chunk_dict[l1+l2+l3+l4]=0
elif chunk_length==5:
    for l1 in special_alphabet:
        for l2 in special_alphabet:
            for l3 in special_alphabet:
                for l4 in special_alphabet:
                    for l5 in special_alphabet:
                        chunk_dict[l1+l2+l3+l4+l5]=0


# go through all words and all chunks, add 1 to the corresponding chunk_dict
for word in data_with_ends:
    for chunk_ind in range(len(word)-chunk_length+1):
        chunk = word[chunk_ind:chunk_ind+chunk_length]
        chunk_dict[chunk]+=1


# return an array with num_generated_words strings
def generate_words(num_generated_words):
    res = []
    
    for i in range(num_generated_words):
        word = (chunk_length-1)*"^"
        for ii in range(100):# make new letters until an ending character "$" is reached. break in case a word becomes extremely long
            new_chunk_beginning = word[1-chunk_length:]
            total_occurences = 0
            for new_l in special_alphabet:
                total_occurences += chunk_dict[new_chunk_beginning+new_l]
            
            choice_threshold = random.randrange(0, total_occurences)# select a number of running sum occurences needed until the current value is chosen
            running_occurence_sum = 0
            for new_l in special_alphabet:# go through all potential new letters and pick one randomly (weighted by frequency)
                new_chunk = new_chunk_beginning + new_l
                running_occurence_sum += chunk_dict[new_chunk]
                if running_occurence_sum > choice_threshold: # the currently chosen letter is above the choice threshold
                    word += new_l
                    break
            if word[-1]=="$": # an ending character has been chosen, the word is ready
                break
        word = word[chunk_length-1:-1] # trim beginning-of-word and end-of-word characters
        res.append(word)
    
    return res

examples=generate_words(output_length)

import json
# print(examples)
# print(json.dumps(examples))
print(json.dumps({"vardi": examples, "virknu garums": chunk_length}))
