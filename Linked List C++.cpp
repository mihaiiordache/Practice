#include <iostream>
#include <string>
using namespace std;
struct Node {
	int value;
	Node* next;
};

Node* addNodeLIFO(int newValue, Node* list) {
	
	
		Node* newNode = new Node;
		newNode->value = newValue;
		newNode->next = list;
		list = newNode;
	
	return list;
}

Node* deleteNode(int valueToDelete, Node* list) {
	Node* aux=list, *aux2=list;
	Node* deleteNode;
	if (list&&list->value == valueToDelete) {
		deleteNode = list;
		list = list->next;
		delete(deleteNode);
	}
	else {
		while (list&&aux->next) {
			 aux= aux->next;
			 if (aux->value == valueToDelete) {
				 deleteNode = aux;
				 aux2->next = aux->next;
				 aux = aux->next;
				 delete(deleteNode);
				 return list;
			}
			 aux2 = aux2->next;
		}
	}
	return list;
}

Node* deleteNode2(int valueToDelete, Node* list) {
	Node* aux = list, *aux2 = list;
	Node* deleteNode;
	
	if(list&&list->value==valueToDelete)
		 while(list->value == valueToDelete) {
			deleteNode = list;
			list = list->next;
			delete(deleteNode);
		}
	else {
		while (list&&aux->next) {
			aux = aux->next;
			if (aux->value == valueToDelete)
				while(aux->value==valueToDelete){
					deleteNode = aux;
					aux2->next = aux->next;
					if(aux->next)
						aux = aux->next;
					else aux = aux2;
					delete(deleteNode);
				}
			aux2 = aux;
		}
	}
	return list;
}

void parseList(Node* list) {
	while (list) {
		cout << list->value << "\n";
		list = list->next;
	}
}

Node* deleteList(Node* list) {
	Node* deleteNode = list;
	while (list&&list->next) {
		list = list->next;
		delete(deleteNode);
		deleteNode = list;
	}
	delete(list);
	list = NULL;
	return list;
}

void addNodeFIFO(Node* &list, int value) {
	Node* node = new Node;
	node->value = value;
	node->next = NULL;
	Node* aux = list;
	if (aux) {
		while (aux->next) {
			aux = aux->next;
		}
		aux->next = node;
	}
	else {
		list = new Node;
		list->value = value;
		list->next = NULL;
	}
}

int main()
{
	std::string name;

	Node* list = new Node;
	list = NULL;
	
	addNodeFIFO(list, 100);
	addNodeFIFO(list, 54);
	addNodeFIFO(list, 55);
	addNodeFIFO(list, 3);
	list = addNodeLIFO(111, list);
	
	parseList(list);
	cout << "\n";

	list=deleteNode(3,list);
	list=deleteNode(54,list);
	list = deleteNode2(5, list);
	
	parseList(list);

	list=deleteList(list);


	cout << "\nList after deleting";
	parseList(list);

	string exit;
	cin >> exit;
}