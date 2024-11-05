import { Component, OnInit } from "@angular/core";
import { TransactionService } from "./transactionService";

@Component({
  selector: "app-transacao",
  templateUrl: "./TransactionComponent.html",
  styleUrls: ["./TransactionComponent.css"],
})

export class TransactionComponent implements OnInit {
  transacoes: any[] = [];
  descricao: string = "";
  valor: number = 0;
  data: string = "";
  tipo_id: number = 1;
  id: number | null = null;

  constructor(private transactionService: TransactionService) {}

  ngOnInit(): void {
    this.loadTransactions();
  }

  loadTransactions() {
    this.transactionService.getTransaction().subscribe((data) => {
      this.transacoes = data;
    });
  }

  onSubmit() {
    if (this.id) {
      this.transactionService
        .updateTransaction(
          this.id,
          this.descricao,
          this.valor,
          this.data,
          this.tipo_id
        )
        .subscribe(() => {
          this.loadTransactions();
          this.clearForm();
        });
    } else {
      this.transactionService
        .createTransaction(this.descricao, this.valor, this.data, this.tipo_id)
        .subscribe(() => {
          this.loadTransactions();
          this.clearForm();
        });
    }
  }

  deleteTransacao(id: number) {
    this.transactionService.deleteTransaction(id).subscribe(() => {
      this.loadTransactions();
    });
  }

  editTransacao(transacao: any) {
    this.id = transacao.id;
    this.descricao = transacao.descricao;
    this.valor = transacao.valor;
    this.data = transacao.data;
    this.tipo_id = transacao.tipo_id;
  }

  clearForm() {
    this.id = null;
    this.descricao = "";
    this.valor = 0;
    this.data = "";
    this.tipo_id = 1;
  }
}
