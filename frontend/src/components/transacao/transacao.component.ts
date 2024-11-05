import { Component, OnInit } from "@angular/core";
import { TransacaoService } from "../transacao/transacao.service";

@Component({
  selector: "app-transacao",
  templateUrl: "./transacao.component.html",
  styleUrls: ["./transacao.component.css"],
})
export class TransacaoComponent implements OnInit {
  transacoes: any[] = [];
  descricao: string = "";
  valor: number = 0;
  data: string = "";
  tipo_id: number = 1;
  id: number | null = null;

  constructor(private transacaoService: TransacaoService) {}

  ngOnInit(): void {
    this.loadTransacoes();
  }

  loadTransacoes() {
    this.transacaoService.getTransacoes().subscribe((data) => {
      this.transacoes = data;
    });
  }

  onSubmit() {
    if (this.id) {
      this.transacaoService
        .updateTransacao(
          this.id,
          this.descricao,
          this.valor,
          this.data,
          this.tipo_id
        )
        .subscribe(() => {
          this.loadTransacoes();
          this.clearForm();
        });
    } else {
      this.transacaoService
        .createTransacao(this.descricao, this.valor, this.data, this.tipo_id)
        .subscribe(() => {
          this.loadTransacoes();
          this.clearForm();
        });
    }
  }

  deleteTransacao(id: number) {
    this.transacaoService.deleteTransacao(id).subscribe(() => {
      this.loadTransacoes();
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
