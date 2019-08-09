from random import randrange
class lista():

    def __init__(self,ile):
        self.lista = list(list())
        self.ile = ile
        for i in range(ile):
            self.lista.append([])
            for j in range(49):
                self.lista[i].append(j + 1)

    def wylosuj(self):
        try:
            for i in range(self.ile):
                while len(self.lista[i]) > 6:
                    self.lista[i].pop(randrange(len(self.lista[i])))
        except ValueError:
            print("Ilosc losow musi byc liczba")

    def __str__(self):
        result = ""
        for i in range(self.ile):
            result = result+self.lista[i].__str__()+"\n"
        return result



ile = int(input("Ile losów?\n"))
listaa = lista(ile)
listaa.wylosuj()
print(listaa)
input()