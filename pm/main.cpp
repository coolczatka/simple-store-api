#include<stdio.h>
#include<math.h>
#include<stdlib.h>
#include<time.h>

short sprawdz(short a, short* tab, short dl){
	int i;
	for(i=dl-1;i>=0;i--){
		if(*(tab+i)==a)
			return 1;
	}
	return 0;
}
main(){
	unsigned short i,j,ile;
	short a[6];
	short *wsk;
	wsk=a;
	printf("Podaj ilosc");
	scanf("%d",&ile);
	srand(time(0));
	for(j=0;j<ile;j++){
		for(i=0;i<6;i++){
			short licz;
			do{
				licz = rand()%49+1;
			}while(sprawdz(licz,wsk,i));
			a[i]=licz;
			printf(" %d",licz);
		}
		printf("\n");
	}
	system("pause");
}