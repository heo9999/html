
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <div><img src="/image/footer_logo.png"/></div>
                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <span>경기도 고양시 일산동구 호수로 358-39, 동문타워1차 409호<br>
                        TEL 031-926-3591 / FAX 031-926-3594<br>
                        COPYRIGHT (C)  ALL RIGHT RESERVED</span>
                        </div>
                    </div>
                    <div class="copyright text-center my-auto">
                        <div class="h6 mb-0 font-weight text-gray-800">
                        <span>주식회사 이투웹<br>
                        120-86-35559<br>
                        대표 : 이정석</span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">로그아웃 하시겠습니까?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">아래버튼을 클릭하시면 종료합니다.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-primary" type="button" value="Logout" onclick="document.location.href='/logout.php';">
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<?
	$db->close();
?>