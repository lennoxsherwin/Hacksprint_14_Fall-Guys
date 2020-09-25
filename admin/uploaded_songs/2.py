lower = 2
upper = 40
prime = []
for num in range(lower, upper + 1):
   if num > 1:
       for i in range(2, num):
           if (num % i) == 0:
               break
       else:
           prime.append(num)
    
from itertools import combinations
two = list(combinations(prime,2))
    
twocombi = [map(str,l) for l in two]
newlist = [int(''.join(s)) for s in twocombi]

newprime = []
for num in newlist:
    if num > 1:
       for i in range(2, num):
           if (num % i) == 0:
               break
       else:
           newprime.append(num)
           
newprime.sort()
min_num = newprime[:1]
max_num = newprime
print(min_num)
