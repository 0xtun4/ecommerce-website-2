package com.tuna.Service;

import com.tuna.DTO.LogInDTO;
import com.tuna.DTO.MemberDTO;
import com.tuna.repositories.response.LoginResponse;
import org.springframework.http.ResponseEntity;

public interface MemberService {
    String addMember(MemberDTO memberDTO);

//    String updateMember(MemberDTO memberDTO);
    String updateMember(MemberDTO memberDTO, Long id);

    String deleteMember(Long memberId);

//    String seeMember(Long id, MemberDTO memberDTO);
//
//    MemberDTO findMemberByName(String memberName);

    LoginResponse loginMember(LogInDTO loginDTO);


}
