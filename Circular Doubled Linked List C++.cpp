#include <iostream>
#include <string>
using namespace std;

struct Node {
	int value;
	Node* prev;
	Node* next;
};

Node* addNode(Node* list, int value) {
	Node* aux = list;
	if (list == NULL) {
		Node* node = new Node;
		node->value = value;
		node->next = node;
		node->prev = node;
		list = node;
	}
	else {
		Node* node = new Node;
		node->value = value;
		node->next = list;
		node->prev = list->prev;
		list->prev = node;
		node->prev->next = node;
	}
	return list;
}

Node* deleteNode(Node* list, int value) {
	if (list&&list->next == list&&list->prev == list&&list->value==value) {
		delete(list);
		list = NULL;
	}
	while(list && list->value == value) {
		Node* node = new Node;
		node = list;
		list = list->next;
		list->prev = node->prev;
		node->prev->next = list;
		delete(node);
	}
	if (list!=NULL) {
		Node* aux = list->next;
		while (aux != list) {
			
			if (aux->next&&aux->value == value) {
				if (aux->next == aux&&aux->prev == aux) {
					delete(list);
					list = NULL;
				}
				aux->prev->next = aux->next;
				aux->next->prev = aux->prev;
				delete(aux);
				aux = list;
			}
			aux = aux->next;
		}
	}
	return list;
}

void parseList(Node* list) {
	Node* aux = list;
	if (aux) {
		while (aux->next != list) {
			cout << aux->value << "\n";
			aux = aux->next;
		}
		cout << aux->value << "\n";

	}
}

Node* deleteList(Node* list) {
	//Node* aux = list;
	while(list!=NULL) {
		if (list->next) {
			list= deleteNode(list, list->value);
		}
	}
	list = NULL;
	return list;
}

void main() {
	Node* list = NULL;
	
	list = addNode(list, 6);
	list = addNode(list, 8);
	list = addNode(list, 7);
	list = addNode(list, 10);

	parseList(list);

	list = deleteNode(list, 6);
	cout << "-----------------\n";

	parseList(list);

	list = deleteList(list);

	cout << "-----------------\n";

	parseList(list);

	string t;
	cin >> t;
}